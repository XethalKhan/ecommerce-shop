<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){

		$name = $_POST["name"];
		$desc = $_POST["desc"];

		if(category_insert($name, $desc) == true){
			http_response_code(201);
		}else{
			http_response_code(500);
			echo json_encode("Internal server error");
		}
	}else{
		http_response_code(401);
		//echo json_encode("You must login");
		echo json_encode($_SESSION);
	}
?>