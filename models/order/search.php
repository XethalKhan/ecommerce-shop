<?php 
	session_start();
	if(isset($_SESSION["uid"]) && $_SESSION["gid"] == 1){

		$query = "SELECT " .
					"o.id AS id, " .
					"u.username AS username, " .
					"o.freight AS freight, " .
					"o.order_date AS order_date, " .
					"o.address AS address, " .
					"CONCAT(o.city, '/', o.country) AS city " .
				"FROM `order` o " .
				"INNER JOIN user u " .
				"ON u.id = o.c_id";

		$customer = $_POST["customer"];
		$maxF = $_POST["maxF"];
		$minF = $_POST["minF"];
		$city = $_POST["city"];
		$country = $_POST["country"];
		$address = $_POST["address"];
		$orderDate = $_POST["orderDate"];
		
		if(!empty($customer)){
			$query = $query . " WHERE u.username = :customer";
		}else{
			$query = $query . " WHERE u.username = u.username";
		}

		if(!empty($maxF)){
			$query = $query . " AND o.freight <= :maxF";
		}

		if(!empty($minF)){
			$query = $query . " AND o.freight >= :minF";
		}

		if(!empty($city)){
			$query = $query . " AND o.city LIKE :city";
		}

		if(!empty($country)){
			$query = $query . " AND o.country = :country";
		}

		if(!empty($address)){
			$query = $query . " AND o.address = :address";
		}

		if(!empty($orderDate)){
			$query = $query . " AND o.order_date = :orderDate";
		}

		$stmt = $conn->prepare($query);

		if(!empty($customer)){
			$stmt->bindParam(":customer", $customer);
		}

		if(!empty($maxF)){
			$stmt->bindParam(":maxF", $maxF);
		}

		if(!empty($minF)){
			$stmt->bindParam(":minF", $minF);
		}

		if(!empty($city)){
			$stmt->bindParam(":city", $city);
		}

		if(!empty($country)){
			$stmt->bindParam(":country", $country);
		}

		if(!empty($address)){
			$stmt->bindParam(":address", $address);
		}

		if(!empty($orderDate)){
			$orderDate = date('Y-m-d', strtotime($orderDate));
			$stmt->bindParam(":orderDate", $orderDate);
		}

		$stmt->execute();
		$rs=$stmt->fetchAll();
		if(count($rs) > 0){
			http_response_code(200);
			echo json_encode($rs);
		}else{
			http_response_code(404);
			echo json_encode("Not found");
		}
	}else{
		http_response_code(401);
		echo json_encode("Login");
	}
?>