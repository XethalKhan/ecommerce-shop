<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){

		require_once("db.php");
		$crm = new DB("root", "root");
		$conn = $crm->getInstance();

		$query = "SELECT id, username, firstname, lastname, email, status FROM user";

		$username = $_POST["user"];
		$firstname = $_POST["fn"];
		$lastname = $_POST["ln"];
		$email = $_POST["mail"];
		$status = $_POST["status"];

		if(!empty($username)){
			$query = $query . " WHERE username = :username";
		}else{
			$query = $query . " WHERE username = username";
		}

		if(!empty($firstname)){
			$query = $query . " AND firstname = :firstname";
		}

		if(!empty($lastname)){
			$query = $query . " AND lastname = :lastname";
		}

		if(!empty($email)){
			$query = $query . " AND email = :email";
		}

		if($status != -1){
			$query = $query . " AND status = :status";
		}

		$stmt = $conn->prepare($query);

		if(!empty($username)){
			$stmt->bindParam(":username", $username);
		}

		if(!empty($firstname)){
			$stmt->bindParam(":firstname", $firstname);
		}

		if(!empty($lastname)){
			$stmt->bindParam(":lastname", $lastname);
		}

		if(!empty($email)){
			$stmt->bindParam(":email", $email);
		}

		if($status != -1){
			$stmt->bindParam(":status", $status);
		}

		$stmt->execute();
		$rs=$stmt->fetchAll();
		if(count($rs) > 0){
			http_response_code(200);
			echo json_encode($rs);
		}else{
			http_response_code(404);
			echo json_encode("Not found");
		}

	}else{
		http_response_code(401);
		echo json_encode("Login");
	}	
?>