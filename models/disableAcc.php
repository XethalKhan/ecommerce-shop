<?php 
	session_start();
	if(isset($_SESSION["uid"])){
		if((isset($_GET["uid"]) && $_SESSION["uid"] == $_GET["uid"]) || (isset($_SESSION["gid"]) && $_SESSION["gid"] == 1 && isset($_GET["uid"]))){
			$uid = $_GET["uid"];

			error_reporting(E_ALL);
			require_once("db.php");
			$crm = new DB("root", "root");
			$conn = $crm->getInstance();

			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM `order` WHERE c_id = :c_id AND status != 1");
			$stmt->bindParam(":c_id", $uid);
			$stmt->execute();
			$rs = $stmt->fetch();

			if($rs->cnt > 0){

			}else{
				$stmt = $conn->prepare("UPDATE user SET status = 1 WHERE id = :id");
				$stmt->bindParam(":id", $uid);
				$test = $stmt->execute();
				if($test == true){
					http_response_code(200);
					if($_SESSION["uid"] == $_GET["uid"]){
						session_destroy();
						require_once("logout.php");
					}else{
						header("Location: ../profile.php?uid=" . $_GET["uid"]);
					}
				}
			}
		}else{
			http_response_code(400);
			echo json_encode("Bad request");
		}
	}else{
		http_response_code(401);
		header("Location: ../login.php");
	}
?>