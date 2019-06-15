<?php

	function user_exists(
		$username 			//POTENTIAL USER
	){
		try{

			global $conn;

			$stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$user=$stmt->fetch();

			if($user){
				return true;
			}else{
				return false;
			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_wrong(
		$username 			//POTENTIAL USER
	){
		try{

			global $conn;

			$stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$user=$stmt->fetch();

			if($user){
				return $user->wrong;
			}else{
				return -1;
			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return -2;
		}
	}

	function user_authenticate(
		$user, 		//USERNAME
		$pass 		//PASSWORD
	){
		try{
			global $conn;
			$stmt = $conn->prepare("SELECT id, grp, username FROM user WHERE username = :username AND password = :password");
			$stmt->bindParam(":username", $user);
			$stmt->bindParam(":password", $pass);
			$stmt->execute();
			$user=$stmt->fetch();

			if($user){
				return true;
			}else{
				return false;
			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_data(
		$username 			//POTENTIAL USER
	){
		try{

			if(!user_exists($username)){
				throw new Exception("Username doesn't exist");
				return false;
			}

			global $conn;

			$stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$user=$stmt->fetch();

			if($user){
				return $user;
			}else{
				return false;
			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_session_exists(
		$session_id			//SESSION HASH
	){

		try{
			global $conn;
			$stmt = $conn->prepare("SELECT * FROM session WHERE hash = :hash");
			$stmt->bindParam(":hash", $session_id);
			$stmt->execute();
			$hash=$stmt->fetch();

			if($hash){
				return $true;
			}else{
				return false;
			}
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_session_start(){
		try{
			global $conn;

			$conn->beginTransaction();

			$session_id = md5(time() + $_SESSION['uid'] + $_SESSION['gid']);
			$t = time() + 600;
			setcookie("session-id", $session_id, $t, SUBFOLDER . "/");
			$stmt = $conn->prepare("INSERT INTO session(hash, uid, gid, access) VALUES(?, ?, ?, ?)");
			$test = $stmt->execute([$session_id, $_SESSION['uid'], $_SESSION['gid'], date("Y-m-d H:i:s", $t)]);

			if($test == true){
				$conn->commit();
				return $session_id;
			}else{
				$conn->rollBack();
				return false;
			}
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_wrong_increase($user){
		try{

			if(!user_exists($user)){
				return false;
			}

			global $conn;

			$conn->beginTransaction();

			$wrongPass = $conn->prepare("UPDATE user SET wrong = wrong + 1 WHERE username = :username");
			$wrongPass->bindParam(":username", $user);
			$test = $wrongPass->execute();

			if($test == true){
				$conn->commit();
				return true;
			}else{
				$conn->rollBack();
				return false;
			}
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_logout(){

		try{
			global $conn;

			$conn->beginTransaction();

			$stmt = $conn->prepare("DELETE FROM session WHERE uid = ? AND hash = ?");
			$test = $stmt->execute([$_SESSION["uid"], $_COOKIE["session-id"]]);

			if($test == false){
				$conn->rollBack();
				return false;
			}

			session_unset();
			session_destroy();
			setcookie("session-id", null, -1, SUBFOLDER . "/");

			$conn->commit();

			return true;

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_signup(
		$user, 			//USERNAME
		$pass,			//PASSWORD
		$mail,			//E-MAIL
		$fn,			//FIRSTNAME
		$ln				//LASTNAME
	){
		try{
			global $conn;

			$conn->beginTransaction();

			$pass = md5($pass);
			$stmt = $conn->prepare(
				"INSERT INTO user(username, password, email, firstname, lastname) ".
				"VALUES(:username, :password, :email, :firstname, :lastname)");
			$stmt->bindParam(":username", $user);
			$stmt->bindParam(":password", $pass);
			$stmt->bindParam(":email", $mail);
			$stmt->bindParam(":firstname",$fn);
			$stmt->bindParam(":lastname",$ln);
			$test = $stmt->execute();

			if($test == true){
				$conn->commit();
				return true;
			}else{
				$conn->rollBack();
				return false;
			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_disable(
		$uid 			//USER ID
	){
		try{

			global $conn;

			$conn->beginTransaction();

			$stmt = $conn->prepare("UPDATE user SET status = 1 WHERE id = :id");
			$stmt->bindParam(":id", $uid);
			$test = $stmt->execute();

			if($test == true){
				$conn->commit();
				return true;
			}else{
				$conn->rollBack();
				return false;
			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_password_update(
		$uid, 			//USER ID
		$new_pass  		//NEW PASSWORD MD5
	){

		try{
			global $conn;

			$conn->beginTransaction();

			$stmt = $conn->prepare(
					"UPDATE user SET password = :password WHERE id = :id");
			$stmt->bindParam(":password", $new_pass);
			$stmt->bindParam(":id", $uid);
			$test = $stmt->execute();

			if($test == true){
				$conn->commit();
				return true;
			}else{
				$conn->rollBack();
				return false;
			}
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function user_update(
		$uid, 				//USER ID
		$fn,				//USER FIRSTNAME
		$ln,				//USER LASTNAME
		$user, 				//USERNAME
		$mail 				//E-MAIL
	){
		try{
			global $conn;

			$conn->beginTransaction();

			$stmt = $conn->prepare(
				"UPDATE user SET firstname = :firstname, lastname = :lastname, username = :username, email = :email WHERE id = :id");
			$stmt->bindParam(":firstname", $fn);
			$stmt->bindParam(":lastname", $ln);
			$stmt->bindParam(":username", $user);
			$stmt->bindParam(":email",$mail);
			$stmt->bindParam(":id",$uid);
			$test = $stmt->execute();

			if($test == true){
				$conn->commit();
				return true;
			}else{
				$conn->rollBack();
				return false;
			}
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function get_user_session_data(){
		try{
			global $conn;

			$stmt = $conn->prepare(
				"SELECT " .
					"u.id, " .
					"u.username, " .
					"u.firstname, " .
					"u.lastname, " .
					"u.email, " .
					"s.hash AS hash, " .
					"g.name AS group_name " .
				"FROM `user` AS u " .
				"INNER JOIN `session` AS s " .
				"ON u.id = s.uid " .
				"INNER JOIN `grp` AS g " .
				"ON u.grp = g.id ");
			$stmt->execute();
			$rs=$stmt->fetchAll();

			return $rs;
			
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}
	}

	function get_user_data_id(
		$uid
	){
		try{

			global $conn;

			$stmt = $conn->prepare("SELECT * FROM user WHERE id = :id");
			$stmt->bindParam(":id", $uid);
			$stmt->execute();
			$rs = $stmt->fetch();

			return $rs;

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return false;
		}
	}

	function get_users(){
		try{
			global $conn;

			$stmt = $conn->prepare(
				"SELECT " .
					"id, " .
					"username, " .
					"firstname, " .
					"lastname, " .
					"email, " .
					"status " .
				"FROM `user` ");
			$stmt->execute();
			$rs=$stmt->fetchAll();

			return $rs;

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return false;
		}
	}

	function user_search(
		$username,
		$firstname,
		$lastname,
		$email,
		$status
	){
		try{
			global $conn;

			$query = "SELECT id, username, firstname, lastname, email, status FROM user";
			$param = [];

			if(!empty($username)){
				$query = $query . " WHERE LOWER(username) LIKE ?";
				$username = "%" . strtolower($username) . "%";
				array_push($param, $username);
			}else{
				$query = $query . " WHERE username = username";
			}

			if(!empty($firstname)){
				$query = $query . " AND LOWER(firstname) LIKE ?";
				$firstname = "%" . strtolower($firstname) . "%";
				array_push($param, $firstname);
			}

			if(!empty($lastname)){
				$query = $query . " AND LOWER(lastname) LIKE ?";
				$lastname = "%" . strtolower($lastname) . "%";
				array_push($param, $lastname);
			}

			if(!empty($email)){
				$query = $query . " AND LOWER(email) LIKE ?";
				$email = "%" . strtolower($email) . "%";
				array_push($param, $email);
			}

			if($status != -1){
				$query = $query . " AND status = ?";
				array_push($param, $status);
			}

			$stmt = $conn->prepare($query);

			$stmt->execute($param);
			$rs=$stmt->fetchAll();

			return $rs;
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return false;
		}
	}

?>