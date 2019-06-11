<?php
	
	function order_add(
		$pid, 			//PRODUCT ID
		$number 		//NUMBER OF PRODUCTS - add = +1, minus = -1, int = concrete number
	){

		try{

			global $conn;

			if($number == "add"){
				if(!(isset($_SESSION["order"][$pid]))){
					$_SESSION["order"][$pid] = 0;
				}
				$_SESSION["order"][$pid] = $_SESSION["order"][$pid] + 1;
			}else if($number == "minus"){
				if(!(isset($_SESSION["order"][$pid]))){
					$_SESSION["order"][$pid] = 0;
				}
				$_SESSION["order"][$pid] = $_SESSION["order"][$pid] - 1;
			}else{
				if(!(isset($_SESSION["order"][$pid]))){
					$_SESSION["order"][$pid] = 0;
				}
				$_SESSION["order"][$pid] = intval($number);
			}
			
			$prodids = array();
			foreach($_SESSION["order"] as $key=>$val){
				if($_SESSION["order"][$key] <= 0){
					unset($_SESSION["order"][$key]);
				}else{
					$prodids[] = $key;
				}
			}
			if(!(empty($prodids))){
				$instmt = "(" . implode(",", $prodids) . ")";
				$query = "SELECT id, name FROM product WHERE id IN " . $instmt;

				$stmt = $conn->prepare($query);
				$stmt->execute();
				$rs=$stmt->fetchall();

				$orderQ = array();
				foreach($rs as $names){
					$orderQ[] = 
						array(
							"id" => $names->id,
							"name" => $names->name,
							"number" => $_SESSION["order"][$names->id]);
				}

				return $orderQ;

			}

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return ["err" => $e->getMessage()];
		}

	}


	function order_complete(
		$c_id,					//CUSTOMER_ID
		$req_date, 				//DATE SHIPMENT IS REQUIRED
		$address, 				//ADDRESS OF DELIVERY
		$city,					//CITY OF DELIVERY
		$region,				//REGION OF DELIVERY
		$country, 				//COUNTRY OF DELIVERY
		$postal_code            //POSTAL CODE OF DELIVERY
	){

		try{
			global $conn;

			$conn->beginTransaction();

			$freight = 0;
			$order_date = date("Y.m.d");

			foreach($_SESSION["order"] as $key=>$val){
				$prodids[] = $key;
			}
			$instmt = "(" . implode(",", $prodids) . ")";
			$query = "SELECT id, name, unit_price AS price, discount AS discount FROM product WHERE id IN " . $instmt;

			$stmt = $conn->prepare($query);
			$stmt->execute();
			$rs=$stmt->fetchall();

			$orderQ = array();
			foreach($rs as $names){
				$orderQ[] = 
					array(
						"id" => $names->id,
						"name" => $names->name,
						"number" => $_SESSION["order"][$names->id],
						"price" => $names->price,
						"discount" => $names->discount);
			}

			foreach($orderQ as $prod){
				$freight = $freight + (double)$prod["number"] * ((double)$prod["price"] * (100 - (double)$prod["discount"]) / 100); 
			}

			if($freight == 0){
				$conn->rollBack();
				return 0;
			}

			$query = 
				"INSERT INTO `order`(c_id, order_date, req_date, freight, address, city, region, country, postal_code) " .
				"VALUES (:c_id, :order_date, :req_date, :freight, :address, :city, :region, :country, :postal_code)";

			$stmt = $conn->prepare($query);
			$stmt->bindParam(":c_id", $c_id);
			$stmt->bindParam(":order_date", $order_date);
			$stmt->bindParam(":req_date", $req_date);
			$stmt->bindParam(":freight", $freight);
			$stmt->bindParam(":address", $address);
			$stmt->bindParam(":city", $city);
			$stmt->bindParam(":region", $region);
			$stmt->bindParam(":country", $country);
			$stmt->bindParam(":postal_code", $postal_code);
			$test = $stmt->execute();

			if($test == false){
				$conn->rollBack();
				return 0;
			}

			$oid = $conn->lastInsertId(); 
			$newQ = "INSERT INTO order_detail(id, p_id, price, quantity, discount) " .
			"VALUES(:o_id, :p_id, :price, :quantity, :discount)";
			foreach($orderQ as $prod){
				$pid = $prod["id"];
				$price = $prod["price"];
				$quantity = $prod["number"];
				$discount = $prod["discount"];

				$po = $conn->prepare($newQ);
				$po->bindParam(":o_id", $oid);
				$po->bindParam(":p_id", $pid);
				$po->bindParam(":price", $price);
				$po->bindParam(":quantity", $quantity);
				$po->bindParam(":discount", $discount);
				$test = $po->execute();

				if($test == false){
					$conn->rollBack();
					return 0;
				}
			}

			$conn->commit();
			return $oid;

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			$conn->rollBack();
			return false;
		}

	}

?>