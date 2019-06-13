<?php 
	if(isset($_POST["pid"])){
		if(isset($_SESSION["uid"])){
			$pid = $_POST["pid"];
			$number = isset($_POST["number"]) && preg_match("/^add|minus|[\d]+$/", $_POST["number"]) ? $_POST["number"] : "0";

			$order = order_add($pid, $number);

			if(isset($order["err"])){
				http_response_code(500);
				echo json_encode($order);
			}else{
				http_response_code(200);
				echo json_encode($order);
			}
		}else{
			http_response_code(401);
			echo json_encode("Login");
		}
	}else{
		http_response_code(400);
		echo json_encode("Bad request");
	}
?>