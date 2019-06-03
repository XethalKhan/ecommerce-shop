<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){
		$query = "SELECT * FROM category";
		$input = false;
		$searchParam = [];

		$name = $_POST["name"];
		$desc = $_POST["desc"];

		if(!empty($name)){
			$input = true;
			$query = $query . " WHERE LOWER(name) LIKE ?";
			$name = "%" . $name. "%";
			array_push($searchParam, $name);
		}else{
			$query = $query . " WHERE name = name";
		}

		if(!empty($desc)){
			$input = true;
			$query = $query . " AND LOWER(info) LIKE ?";
			$desc = "%" . $desc. "%";
			array_push($searchParam, $desc);
		}else{
			$query = $query . " AND info = info";
		}

		$stmt = $conn->prepare($query);
		
		if($input){
			$stmt->execute($searchParam);
		}else{
			$stmt->execute();
		}

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