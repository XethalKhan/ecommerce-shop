<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){
		require_once("db.php");
		$crm = new DB("root", "root");
		$conn = $crm->getInstance();

		$query = "SELECT * FROM category";

		$name = $_POST["name"];

		if(!empty($name)){
			$query = $query . " WHERE name = :name";
		}else{
			$query = $query . " WHERE name = name";
		}

		$stmt = $conn->prepare($query);
		
		if(!empty($name)){
			$stmt->bindParam(":name", $name);
		}

		$stmt->execute();
		$rs = $stmt->fetchall();

		if(count($rs) > 0){
			http_response_code(200);
			echo json_encode($rs);
		}else{
			http_response_code(404);
			echo json_encode("Not found");
		}
	}else{
		http_response_code(401);
		echo json_encode("You must login");
	}
?>