<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){
		$query = "UPDATE category SET name = :name, info = :info WHERE id = :id";

		$id = $_POST["id"];
		$name = $_POST["name"];
		$desc = $_POST["desc"];

		$stmt = $conn->prepare($query);
		$stmt->bindParam(":id", $id);
		$stmt->bindParam(":name", $name);
		$stmt->bindParam(":info", $desc);
		$test = $stmt->execute();

		if($test == true){
			http_response_code(200);
			echo json_encode("Success");
		}else{
			http_response_code(500);
			echo json_encode("Internal error");
		}
	}else{
		http_response_code(401);
		echo json_encode("You must login");
	}
?>