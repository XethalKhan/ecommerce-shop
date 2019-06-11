<?php 
	session_start();
	header("Content-type: application/json");
	if(isset($_POST["status"]) && isset($_SESSION["uid"])){
		$gender = trim($_POST["gender"]);
		$learnVal = trim($_POST["learnVal"]);
		$learnTxt = trim($_POST["learnTxt"]);
		$products = $_POST["products"];
		$prodGrade = trim($_POST["prodGrade"]);
		$deliveryGrade = trim($_POST["deliveryGrade"]);
		$comm = isset($_POST["comment"]) ? trim($_POST["comment"]) : null;

		$errArr = array();
		$status = true;

		if(empty($gender)){
			$status = false;
			$errArr[] = array("id" => "gndErr", "msg" => "Gender is not selected");
		}
		if($learnVal == 0){
			$status = false;
			$errArr[] = array("id" => "lnValErr", "msg" => "Choose how did you find out about us");
		}
		if($learnVal == 4 && strlen($learnTxt) < 3){
			$status = false;
			$errArr[] = array("id" => "lnTxtErr", "msg" => "Be more precise how did you find out about us");
		}
		if(count($products) == 0){
			$status = false;
			$errArr[] = array("id" => "prodTypeErr", "msg" => "Choose at least one type of product you would like to be added in our offer");
		}
		if(!(preg_match("/^(0[1-9]|[1-9]|10)$/", $prodGrade))){
			$status = false;
			$errArr[] = array("id" => "prodGradeErr", "msg" => "Grade our product offer from 1 to 10");
		}
		if(!(preg_match("/^(0[1-9]|[1-9]|10)$/", $deliveryGrade))){
			$status = false;
			$errArr[] = array("id" => "delivGradeErr", "msg" => "Grade our delivery system from 1 to 10");
		}

		if($status == true){
			$idc = $_SESSION["uid"];

			$test = survey_answer($idc, $gender, $learnVal, $learnTxt, $prodGrade, $deliveryGrade, $comm, $products);

			if($test == true){
				http_response_code(200);
				echo json_encode("Success");
			}else{
				http_response_code(500);
				echo json_encode("Internal server error");
			}
		}
		else{
			http_response_code(400);
			echo json_encode($errArr);
		}
	}else{
		http_response_code(401);
		echo json_encode("Login first");
		$_SESSION["msg"] = "You must be logged in to complete our survey!";
	}
?>