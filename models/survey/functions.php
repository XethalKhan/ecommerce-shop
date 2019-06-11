<?php
		
	function survey_answer(
			$idc,					//CUSTOMER ID
			$gender,				//CUSTOMER GENDER
			$learnVal,				//HOW DID CUSTOMER FINDOUT ABOUT US
			$learnTxt = "",			//HOW DID CUSTOMER FIND OUT ABOUT US - OPTIONAL
			$prodGrade, 			//PRODUCT GRADE 1 - 10
			$deliveryGrade,			//DELIVERY GRADE 1 - 10
			$comm,					//COMMENT
			$products				//ARRAY OF PRODUCT TYPES CUSTOMER WANTS
	){
		try{
			global $conn;

			$conn->beginTransaction();

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
			$test = $stmt->execute();

			if($test == false){
				$conn->rollBack();
				return false;
			}

			foreach($products as $p){
				$stmt = $conn->prepare(
					"INSERT INTO survey_cbx(id, val) ".
					"VALUES(:c_id, :val)");
				$stmt->bindParam(":c_id", $idc);
				$stmt->bindParam(":val", $p);
				$test = $stmt->execute();

				if($test == false){
					$conn->rollBack();
					return false;
				}
			}

			$conn->commit();
			return true;
		}catch(Exception $e){
			$name = date("dmy");
			$err_log = file(BASE_FILE . "/data/error/" . $name, "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}

	}

?>