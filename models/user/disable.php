<?php 
	session_start();
	if(isset($_SESSION["uid"])){
		if((isset($_GET["id"]) && $_SESSION["uid"] == $_GET["id"]) || (isset($_SESSION["gid"]) && $_SESSION["gid"] == 1 && isset($_GET["id"]))){
			$uid = $_GET["id"];

			$stmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM `order` WHERE c_id = :c_id AND status != 1");
			$stmt->bindParam(":c_id", $uid);
			$stmt->execute();
			$rs = $stmt->fetch();

			if($rs->cnt > 0){
				header("Location: http://" . BASE_HREF . "/user/" . $_GET["id"]);
			}else{
				$stmt = $conn->prepare("UPDATE user SET status = 1 WHERE id = :id");
				$stmt->bindParam(":id", $uid);
				$test = $stmt->execute();
				if($test == true){
					http_response_code(200);
					if($_SESSION["uid"] == $_GET["uid"]){
						session_destroy();
						require_once(BASE_FILE . "/models/user/logout.php");
					}else{
						header("Location: http://" . BASE_HREF . "/user/" . $_GET["id"]);
					}
				}
			}
		}else{
			http_response_code(400);
			echo json_encode("Bad request");
		}
	}else{
		http_response_code(401);
		header("Location: http:// " . BASE_HREF . "/login");
	}
?>