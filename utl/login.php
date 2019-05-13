<?php 
	if(isset($_POST["tbUser"]) && isset($_POST["tbPass"])){
		$user = $_POST["tbUser"];
		$pass = md5($_POST["tbPass"]);

		require_once("db.php");
		$crm = new DB("id8082146_root", "faksc0ece");
		$conn = $crm->getInstance();
		$stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
		$stmt->bindParam(":username", $user);
		$stmt->execute();
		$rs=$stmt->fetch();
		if($rs){
			session_start();
			if($rs->wrong > 4){
				$_SESSION['msg'] = "Too many wrong attempts to login, please contact administrator with registred e-mail";
				header("Location: ../login.php");
				exit;
			}
			else if($rs->password == $pass){
				$_SESSION['uid'] = $rs->id;
				$_SESSION['gid'] = $rs->grp;
				$_SESSION['user'] = $rs->username;
				$_SESSION['order'] = array();
				header("Location: ../index.php");
				exit;
			}else{
				$id = $rs->id;
				$count = $rs->wrong + 1;
				$wrongPass = $conn->prepare("UPDATE user SET wrong = :new_wrong WHERE id = :id");
				$wrongPass->bindParam(":new_wrong", $count);
				$wrongPass->bindParam(":id", $id);
				$wrongPass->execute();
				$_SESSION['msg'] = "Wrong password, please try again";
				header("Location: ../login.php");
				exit;
			}
		}
		else{
			header("Location: ../signup.php");
			exit;
		}
	}
?>