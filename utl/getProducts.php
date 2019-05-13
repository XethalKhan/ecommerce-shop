<?php 
	session_start();

	require_once("db.php");
	$crm = new DB("root", "root");
	$conn = $crm->getInstance();

	$query = "SELECT id, name, unit_price, cat_id, img FROM product";

	$name = $_POST["name"];
	$maxPrice = $_POST["maxPrice"];
	$minPrice = $_POST["minPrice"];
	$cat = $_POST["cat"];
	$discount = $_POST["discount"];
	$stock = $_POST["stock"];

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
	$rs=$stmt->fetchAll();
	if(count($rs) > 0){
		http_response_code(200);
		echo json_encode($rs);
	}else{
		http_response_code(404);
		echo json_encode("Not found");
	}

?>