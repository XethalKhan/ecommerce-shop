<?php 
	session_start();
	header("Content-type: application/json");
	if(isset($_POST["status"]) && isset($_SESSION["uid"])){
		require_once("db.php");

		$gender = trim($_POST["gender"]);
		$learnVal = trim($_POST["learnVal"]);
		$learnTxt = trim($_POST["learnTxt"]);
		$products = $_POST["products"];
		$prodGrade = trim($_POST["prodGrade"]);
		$deliveryGrade = trim($_POST["deliveryGrade"]);
		$comm = isset($_POST["comment"]) ? trim($_POST["comment"]) : null;

		$errArr = array();
		$status = true;

		$crm = new DB("root", "root");
		$conn = $crm->getInstance();

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
			$stmt = $conn->prepare(
				"INSERT INTO survey(id_c, gender, findout, findout_txt, product, delivery, comment) ".
				"VALUES(:idc, :gender, :findout, :findout_txt, :product, :delivery, :comment)");
			$idc = $_SESSION["uid"];
			$stmt->bindParam(":idc", $idc);
			$stmt->bindParam(":gender", $gender);
			$stmt->bindParam(":findout", $learnVal);
			$stmt->bindParam(":findout_txt", $learnTxt);
			$stmt->bindParam(":product",$prodGrade);
			$stmt->bindParam(":delivery",$deliveryGrade);
			$stmt->bindParam(":comment",$comm);
			$stmt->execute();

			foreach($products as $p){
				$stmt = $conn->prepare(
					"INSERT INTO survey_cbx(c_id, val) ".
					"VALUES(:c_id, :val)");
				$stmt->bindParam(":c_id", $idc);
				$stmt->bindParam(":val", $p);
				$stmt->execute();
			}

			http_response_code(200);
			echo json_encode("Success");
		}
		else{
			http_response_code(400);
			echo json_encode($errArr);
		}
	}else{
		http_response_code(401);
		echo json_encode("Login first");
	}
?>