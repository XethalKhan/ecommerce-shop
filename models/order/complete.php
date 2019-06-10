<?php
	session_start();

	if(isset($_POST["btnUploadOrder"])){

	$query = "SELECT MAX(id) AS cnt FROM `order`";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$rs=$stmt->fetch();

	$cnt = $rs->cnt + 1;
	$freight = 0;

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

	$query = 
		"INSERT INTO `order`(id, c_id, order_date, req_date, freight, address, city, region, country, postal_code) " .
		"VALUES (:id, :c_id, :order_date, :req_date, :freight, :address, :city, :region, :country, :postal_code)";

	$c_id = $_SESSION["uid"];
	$order_date = date("Y.m.d");
	$req_date = $_POST["tbReqDate"];
	$req_date = date('Y-m-d', strtotime($req_date));
	$address = $_POST["tbAddress"];
	$city = $_POST["tbCity"];
	$country = $_POST["tbCountry"];
	$region = $_POST["tbRegion"];
	$postal = $_POST["tbPostal"];

	$stmt = $conn->prepare($query);
	$stmt->bindParam(":id", $cnt);
	$stmt->bindParam(":c_id", $c_id);
	$stmt->bindParam(":order_date", $order_date);
	$stmt->bindParam(":req_date", $req_date);
	$stmt->bindParam(":freight", $freight);
	$stmt->bindParam(":address", $address);
	$stmt->bindParam(":city", $city);
	$stmt->bindParam(":region", $region);
	$stmt->bindParam(":country", $country);
	$stmt->bindParam(":postal_code", $postal);
	$stmt->execute();

	$newQ = "INSERT INTO order_detail(id, p_id, price, quantity, discount) " .
			"VALUES(:o_id, :p_id, :price, :quantity, :discount)";
	foreach($orderQ as $prod){
		$pid = $prod["id"];
		$price = $prod["price"];
		$quantity = $prod["number"];
		$discount = $prod["discount"];

		$po = $conn->prepare($newQ);
		$po->bindParam(":o_id", $cnt);
		$po->bindParam(":p_id", $pid);
		$po->bindParam(":price", $price);
		$po->bindParam(":quantity", $quantity);
		$po->bindParam(":discount", $discount);
		$po->execute();
	}

	unset($_SESSION["order"]);
	header("Location: http://" . BASE_HREF . "/user/" . $_SESSION["uid"]);
}?>