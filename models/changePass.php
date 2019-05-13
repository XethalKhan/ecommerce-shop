<?php 
	session_start();
	if(isset($_SESSION["uid"])){
		$oldMD = md5($_POST["old"]);
		$old = $_POST["old"];
		$newPass = $_POST["new"];
		$newPassRep = $_POST["newRep"];
		$user = $_SESSION["uid"];
		$status = true;

		require_once("db.php");
		$crm = new DB("root", "root");
		$conn = $crm->getInstance();

		$goodPass = $conn->prepare("SELECT * FROM user WHERE id = :id AND password = :password");
		$goodPass->bindParam(":id", $user);
		$goodPass->bindParam(":password", $old);
		$goodPass->execute();
		$row = $goodPass->fetch();
		if(!($row)){
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
			$stmt = $conn->prepare(
				"UPDATE user SET password = :password WHERE id = :id");
			$stmt->bindParam(":password", $newPass);
			$stmt->bindParam(":id", $user);
			$stmt->execute();
			http_response_code(203);
			echo json_encode("SUCCESS");
		}else{
			http_response_code(400);
			echo json_encode($errArr);
		}
	}
?>