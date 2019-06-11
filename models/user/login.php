<?php 
	if(isset($_POST["tbUser"]) && isset($_POST["tbPass"])){
		$user = $_POST["tbUser"];
		$pass = md5($_POST["tbPass"]);

		$attempts = user_wrong($user);
		if($attempts >= 0){
			session_start();
			if($attempts == 4){
				$_SESSION['msg'] = "Too many wrong attempts to login, please contact administrator with registred e-mail";
				header("Location: http://" . BASE_HREF . "/login");
				exit;
			}
			if(user_authenticate($user, $pass)){
				$info = user_data($user);

				if($info == false){
					header("Location: http://" . BASE_HREF . "/login");
				} 

				$_SESSION['uid'] = $info->id;
				$_SESSION['gid'] = $info->grp;
				$_SESSION['user'] = $info->username;
				$_SESSION['order'] = array();
				user_session_start();
				header("Location: http://" . BASE_HREF . "/home");
				exit;
			}else{
				user_wrong_increase($user);
				$_SESSION['msg'] = "Wrong password, please try again";
				header("Location: http://" . BASE_HREF . "/login");
				exit;
			}
		}else if($attempts == -2){
			$_SESSION['msg'] = "Server error while logging in, please try again later";
			header("Location: http://" . BASE_HREF . "/login");
			exit;
		}
		else{
			header("Location: http://" . BASE_HREF . "/sign-up");
			exit;
		}
	}
?>