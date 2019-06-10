//<?php
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
			$stmt = $conn->prepare(
				"UPDATE user SET firstname = :firstname, lastname = :lastname, username = :username, email = :email WHERE id = :id");
			$stmt->bindParam(":firstname", $fn);
			$stmt->bindParam(":lastname", $ln);
			$stmt->bindParam(":username", $user);
			$stmt->bindParam(":email",$mail);
			$stmt->bindParam(":id",$uid);
			$stmt->execute();
			$msg = "User information successfully updated";
		}
	}else{
		$msg = "Bad request, try again";
	}
	$_SESSION["msg"] = $msg;
	header("LOcation: http://" . BASE_HREF . "/user-change/" . $_POST["uid"]);
?>