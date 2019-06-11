<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){
		$id = $_POST["id"];

		if(dismiss_ticket($id) == true){
			http_response_code(200);
			echo json_encode("Success");
		}else{
			http_response_code(500);
			echo json_encode("Internal server error");
		}
	}else{
		http_response_code(401);
		echo json_encode("You must log in");
	}
?>