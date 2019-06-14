<?php
	session_start();
	error_reporting(E_ALL);

	$msg = "";
	$test = true;
	if(isset($_POST["btnModUser"])){
		$user = trim($_POST["tbUser"]);
		$mail = trim($_POST["tbMail"]);
		$fn = trim($_POST["tbFn"]);
		$ln = trim($_POST["tbLn"]);
		$uid = $_POST["uid"];

		if(user_exists($user)){
			$test = false;
			$msg = "Username already exists!";
		}
		if(empty($fn)){
			$test = false;
			$msg = "Firstname must not be empty!";
		}
		if(empty($ln)){
			$test = false;
			$msg = "Lastname must not be empty!";
		}
		if(!(preg_match("/^[a-zA-Z0-9_%+-]+(\.[a-zA-Z0-9_%+-]+)*@[a-z\.\-]+\.[a-z]{2,3}$/", $mail))){
			$test = false;
			$msg = "E-mail is in bad format!";
		}
		if($test == true){
			if(user_update($uid, $fn, $ln, $user, $mail)){
				$msg = "User information successfully updated";
				$_SESSION["user"] = $user;
			}else{
				http_response_code(500);
			}
		}
	}else{
		$msg = "Bad request, try again";
	}
	$_SESSION["msg"] = $msg;
	header("Location: http://" . BASE_HREF . "/user-change/" . $_POST["uid"]);
?>