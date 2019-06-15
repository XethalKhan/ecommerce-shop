<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){

		$customer = $_POST["customer"];
		$maxF = $_POST["maxF"];
		$minF = $_POST["minF"];
		$city = $_POST["city"];
		$country = $_POST["country"];
		$address = $_POST["address"];
		$orderDate = $_POST["orderDate"];

		$rs=order_search($customer, $maxF, $minF, $city, $country, $address, $orderDate);
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