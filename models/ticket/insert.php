<?php 
	session_start();
	if(isset($_SESSION["uid"])){
		if(isset($_POST["txtTicket"])){
			$uid = $_SESSION["uid"];
			$txt = $_POST["txtTicket"];
			$status = true;
			$errArr = array();
			$cnt = 0;

			$stmt = $conn->prepare("SELECT MAX(id) AS max FROM ticket");
			$stmt->execute();
			$rs = $stmt->fetch();

			if($rs){
				$cnt = $rs->max;
			}

			$cnt = $cnt + 1;

			if(strlen($txt) < 50){
				$status = false;
				$errArr[] = array("id" => "txtErr", "msg" => "Text must be at least 50 characters long");
			}

			if($status = true){
				$stmt = $conn->prepare("INSERT INTO ticket(id, id_c, request) VALUES(:id, :id_c, :request)");
				$stmt->bindParam(":id", $cnt);
				$stmt->bindParam(":id_c", $uid);
				$stmt->bindParam(":request", $txt);
				$test = $stmt->execute();

				if($test == true){
					http_response_code(200);
					echo json_encode($cnt); 
				}
			}else{
				http_response_code(400);
				echo json_encode($errArr);
			}
		}else{
			$errArr[] = array("id" => "txtErr", "msg" => "Ticket text is not set");
			http_response_code(400);
			echo json_encode($errArr);
		}
	}else{
		$errArr[] = array("id" => "txtErr", "msg" => "You are not logged in");
		http_response_code(401);
		echo json_encode($errArr);
	}
?>