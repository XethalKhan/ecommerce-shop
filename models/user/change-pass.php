<?php 
	session_start();
	if(isset($_SESSION["uid"])){
		$oldMD = md5($_POST["old"]);
		$old = $_POST["old"];
		$newPass = $_POST["new"];
		$newPassRep = $_POST["newRep"];
		$user = $_SESSION["uid"];
		$status = true;

		if(!(user_authenticate($_SESSION["user"], $oldMD))){
			$status = false;
			$errArr[] = array("id" => "oldErr", "msg" => "Wrong password");
		}

		if(!(preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!]).{6,20})$/", $old))){
			$status = false;
			$errArr[] = array("id" => "oldErr", "msg" => "Old password is not in valid form");
		}
		if(!(preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!]).{6,20})$/", $newPass))){
			$status = false;
			$errArr[] = array("id" => "oldErr", "msg" => "New password is not in valid form");
		}
		if(!(preg_match("/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%!]).{6,20})$/", $newPassRep))){
			$status = false;
			$errArr[] = array("id" => "oldErr", "msg" => "Repeated new password is not in valid form");
		}
		$newPass = md5($newPass);
		if($status == true){
			if(user_password_update($user, $newPass)){
				http_response_code(204);
				echo json_encode("SUCCESS");
			}else{
				http_response_code(500);
				echo json_encode("Internal server error");
			}
		}else{
			http_response_code(400);
			echo json_encode($errArr);
		}
	}
?>