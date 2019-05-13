<?php 
	session_start();
	require_once("db.php");
	$crm = new DB("root", "root");
	$conn = $crm->getInstance();
	if(isset($_POST["pid"])){
		if(isset($_SESSION["uid"])){
			$pid = $_POST["pid"];
			$number = $_POST["number"];

			if($number == "add"){
				if(!(isset($_SESSION["order"][$pid]))){
					$_SESSION["order"][$pid] = 0;
				}
				$_SESSION["order"][$pid] = $_SESSION["order"][$pid] + 1;
			}else if($number == "minus"){
				if(!(isset($_SESSION["order"][$pid]))){
					$_SESSION["order"][$pid] = 0;
				}
				$_SESSION["order"][$pid] = $_SESSION["order"][$pid] - 1;
			}else{
				if(!(isset($_SESSION["order"][$pid]))){
					$_SESSION["order"][$pid] = 0;
				}
				$_SESSION["order"][$pid] = $number;
			}
			
			$prodids = array();
			foreach($_SESSION["order"] as $key=>$val){
				if($_SESSION["order"][$key] <= 0){
					unset($_SESSION["order"][$key]);
				}else{
					$prodids[] = $key;
				}
			}
			if(!(empty($prodids))){
				$instmt = "(" . implode(",", $prodids) . ")";
				$query = "SELECT id, name FROM product WHERE id IN " . $instmt;

				$stmt = $conn->prepare($query);
				$stmt->execute();
				$rs=$stmt->fetchall();

				$orderQ = array();
				foreach($rs as $names){
					$orderQ[] = 
						array(
							"id" => $names->id,
							"name" => $names->name,
							"number" => $_SESSION["order"][$names->id]);
				}

				http_response_code(200);
				echo json_encode($orderQ);
			}else{
				http_response_code(201);
				echo json_encode("No products selected");
			}
		}else{
			http_response_code(401);
			echo json_encode("Login");
		}
	}else{
		http_response_code(400);
		echo json_encode("Bad request");
	}
?>