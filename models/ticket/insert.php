<?php 
	session_start();
	if(isset($_SESSION["uid"])){
		if(isset($_POST["txtTicket"])){
			$uid = $_SESSION["uid"];
			$txt = $_POST["txtTicket"];
			$status = true;
			$errArr = array();

			if(strlen($txt) < 50){
				$status = false;
				$errArr[] = array("id" => "txtErr", "msg" => "Text must be at least 50 characters long");
			}

			if($status = true){
				$id = ticket_insert($uid, $txt);
				if($id > 0){
					http_response_code(200);
					echo json_encode($id); 
				}else{
					http_response_code(500);
					echo json_encode("Internal server error"); 
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