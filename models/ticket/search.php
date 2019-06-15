<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){

		$id = $_POST["id"];
		$date = $_POST["date"];
		$customer = $_POST["customer"];
		
		$rs=ticket_search($id, $date, $customer);
		if($rs === false){
			http_response_code(500);
			echo json_encode("Internal server error");
		}else{
			http_response_code(200);
			echo json_encode($rs);
		}
	}else{
		http_response_code(401);
		echo json_encode("Login");
	}
?>