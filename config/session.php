<?php
	if(isset($_SESSION["uid"]) && isset($_SESSION["gid"])){
		$stmt = $conn->prepare("SELECT hash, access FROM session WHERE uid = ? AND gid = ?");
		$stmt->execute([$_SESSION["uid"], $_SESSION["gid"]]);
		$rs = $stmt->fetch();
		$current_time = time();
		$last_time = strtotime($rs->access);
		$test = true;

		if($rs->hash != $_COOKIE["session-id"] || !isset($_COOKIE["session-id"])){
			$test = false;
		}

		if($current_time > $last_time){
			$test = false;
		}

		if($test == false){
			$stmt = $conn->prepare("DELETE FROM session WHERE uid = ? AND hash = ?");
			$stmt->execute([$_SESSION["uid"], $_COOKIE["session-id"]]);

			setcookie("session-id", null, -1, SUBFOLDER . "/");
			session_unset();
			$_SESSION["msg"] = "Your session has expired, please log in";
			//header("Location: http://" . BASE_HREF . "/login");
		}else{
			$t = time() + 600;
			$stmt = $conn->prepare("UPDATE session SET access = ? WHERE hash = ? AND uid = ?");
			$stmt->execute([date("Y-m-d H:i:s", $t), $_COOKIE['session-id'], $_SESSION['uid']]);
			setcookie("session-id", $rs->hash, $t, SUBFOLDER . "/");
		}
	}else{
		echo "<script>document.cookie = 'session-id=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';</script>";
	}
?>