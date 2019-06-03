<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){
		$id = $_POST["id"];

		$query = "UPDATE `ticket` SET status = 2 WHERE id = :id";

		$stmt = $conn->prepare($query);
		$stmt->bindParam(":id", $id);
		$test = $stmt->execute();

		if($test == true){
			http_response_code(200);
			echo json_encode("Success");
		}else{
			http_response_code(400);
			echo json_encode("Bad request");
		}
	}else{
		http_response_code(401);
		echo json_encode("You must log in");
	}
?>