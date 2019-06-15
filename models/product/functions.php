<?php

	function product_pagination(
		$pagination = 0,
		$cat = 0,
		$name = "",
		$maxPrice = 0,
		$minPrice = 0,
		$discount="false",
		$stock="false"
	){
		try{
			global $conn;

			$query = "SELECT id, name, unit_price, cat_id, img FROM product";

			if(!empty($name)){
				$query = $query . " WHERE name = :name";
			}else{
				$query = $query . " WHERE name = name";
			}

			if(!empty($maxPrice)){
				$query = $query . " AND unit_price <= :maxPrice";
			}

			if(!empty($minPrice)){
				$query = $query . " AND unit_price >= :minPrice";
			}

			if(!empty($cat)){
				$query = $query . " AND cat_id = :cat";
			}

			if($discount == "true"){
				$query = $query . " AND discount > 0";
			}

			if($stock == "true"){
				$query = $query . " AND unit_in_stock > 0";
			}

			$query = $query . " LIMIT :pagination, 15";

			$stmt = $conn->prepare($query);

			if(!empty($name)){
				$stmt->bindParam(":name", $name);
			}

			if(!empty($maxPrice)){
				$stmt->bindParam(":maxPrice", $maxPrice);
			}

			if(!empty($minPrice)){
				$stmt->bindParam(":minPrice", $minPrice);
			}

			if(!empty($cat)){
				$stmt->bindParam(":cat", $cat);
			}

			$pagination = $pagination * 15;
			$stmt->bindParam(":pagination", $pagination, PDO::PARAM_INT);

			$stmt->execute();
			return $stmt->fetchAll();

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return false;
		}

	}

	function product_pagination_number(
	$cat = 0,
	$name = "",
	$maxPrice = 0,
	$minPrice = 0,
	$discount="false",
	$stock="false"){
		try{
			global $conn;

			$query = "SELECT COUNT(*) AS cnt FROM product";

			if(!empty($name)){
				$query = $query . " WHERE name = :name";
			}else{
				$query = $query . " WHERE name = name";
			}

			if(!empty($maxPrice)){
				$query = $query . " AND unit_price <= :maxPrice";
			}

			if(!empty($minPrice)){
				$query = $query . " AND unit_price >= :minPrice";
			}

			if(!empty($cat)){
				$query = $query . " AND cat_id = :cat";
			}

			if($discount == "true"){
				$query = $query . " AND discount > 0";
			}

			if($stock == "true"){
				$query = $query . " AND unit_in_stock > 0";
			}

			$stmt = $conn->prepare($query);

			if(!empty($name)){
				$stmt->bindParam(":name", $name);
			}

			if(!empty($maxPrice)){
				$stmt->bindParam(":maxPrice", $maxPrice);
			}

			if(!empty($minPrice)){
				$stmt->bindParam(":minPrice", $minPrice);
			}

			if(!empty($cat)){
				$stmt->bindParam(":cat", $cat);
			}

			$stmt->execute();
			$rs = $stmt->fetch();
			return ceil($rs->cnt / 15);

		}catch(Exception $e){
			$name = date("dmy");
			$err_log = fopen(BASE_FILE . "/data/error/" . $name . ".txt", "a");

			$time = date("h:i:s");
			fwrite($err_log, $time . "\t" . $e->getMessage() . "\n");
			fclose($err_log);

			return false;
		}
	}

?>