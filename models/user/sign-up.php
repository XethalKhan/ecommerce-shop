<?php 
	header("Content-type: application/json");
	if(isset($_POST["status"])){

		$user = trim($_POST["user"]);
		$pass = trim($_POST["pass"]);
		$mail = trim($_POST["mail"]);
		$fn = trim($_POST["fn"]);
		$ln = trim($_POST["ln"]);

		$errArr = array();
		$status = true;

		if(user_exists($user)){
			$status = false;
			$errArr[] = array("id" => "userErr", "msg" => "User already exists");
		}
		if(empty($fn)){
			$status = false;
			$errArr[] = array("id" => "fnErr", "msg" => "Firstname is not entered");
		}
		if(empty($ln)){
			$status = false;
			$errArr[] = array("id" => "lnErr", "msg" => "Lastname is not entered");
		}
		if(!(preg_match("/^[a-zA-Z0-9_%+-]+(\.[a-zA-Z0-9_%+-]+)*@[a-z\.\-]+\.[a-z]{2,3}$/", $mail))){
			$status = false;
			$errArr[] = array("id" => "mailErr", "msg" => "E-mail is not in valid form");
		}
		if(!(preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!]).{6,20})$/", $pass))){
			$status = false;
			$errArr[] = array("id" => "passErr", "msg" => "Password is not in valid form");
		}
		if($status == true){
			
			if(user_signup($user, $pass, $mail, $fn, $ln) == true){
				session_start();
				$_SESSION["msg"] = "User successfully created";
				http_response_code(203);
				echo json_encode("User successfully created");
			}else{
				http_response_code(500);
				echo json_encode("Internal server error");
			}
		}
		else{
			http_response_code(400);
			echo json_encode($errArr);
		}
	}	
?>