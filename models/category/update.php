<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){

		$id = $_POST["id"];
		$name = $_POST["name"];
		$desc = $_POST["desc"];

		if(category_update($id, $name, $desc) == true){
			http_response_code(200);
			echo json_encode("Success");
		}else{
			http_response_code(500);
			echo json_encode("Internal server error");
		}
	}else{
		http_response_code(401);
		echo json_encode("You must login");
	}
?>