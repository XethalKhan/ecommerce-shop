<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){

		$username = $_POST["user"];
		$firstname = $_POST["fn"];
		$lastname = $_POST["ln"];
		$email = $_POST["mail"];
		$status = $_POST["status"];

		$rs = user_search($username, $firstname, $lastname, $email, $status);

		if($rs === false){
			http_response_code(500);
			echo json_encode("Internal server error");
		}else{
			http_response_code(200);
			echo json_encode($rs);
		}

	}else{
		http_response_code(401);
		echo json_encode("Login");
	}	
?>