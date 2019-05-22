<?php 
	if(isset($_POST["tbUser"]) && isset($_POST["tbPass"])){
		$user = $_POST["tbUser"];
		$pass = md5($_POST["tbPass"]);

		$stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
		$stmt->bindParam(":username", $user);
		$stmt->execute();
		$rs=$stmt->fetch();
		if($rs){
			session_start();
			if($rs->wrong > 4){
				$_SESSION['msg'] = "Too many wrong attempts to login, please contact administrator with registred e-mail";
				header("Location: http://" . BASE_HREF . "/login");
				exit;
			}
			else if($rs->password == $pass){
				$_SESSION['uid'] = $rs->id;
				$_SESSION['gid'] = $rs->grp;
				$_SESSION['user'] = $rs->username;
				$_SESSION['order'] = array();
				$session_id = md5(time() + $_SESSION['uid'] + $_SESSION['gid']);
				setcookie("session-id", $session_id);
				$stmt = $conn->prepare("INSERT INTO session(hash, uid, gid) VALUES(?, ?, ?)");
				$stmt->execute([$session_id, $_SESSION['uid'], $_SESSION['gid']]);
				header("Location: http://" . BASE_HREF . "/home");
				exit;
			}else{
				$id = $rs->id;
				$count = $rs->wrong + 1;
				$wrongPass = $conn->prepare("UPDATE user SET wrong = :new_wrong WHERE id = :id");
				$wrongPass->bindParam(":new_wrong", $count);
				$wrongPass->bindParam(":id", $id);
				$wrongPass->execute();
				$_SESSION['msg'] = "Wrong password, please try again";
				header("Location: http://" . BASE_HREF . "/login");
				exit;
			}
		}
		else{
			header("Location: http://" . BASE_HREF . "/sign-up");
			exit;
		}
	}
?>