<?php 
	session_start();

	$pagination = $_POST["pagination"];
	$name = $_POST["name"];
	$maxPrice = $_POST["maxPrice"];
	$minPrice = $_POST["minPrice"];
	$cat = $_POST["cat"];
	$discount = $_POST["discount"];
	$stock = $_POST["stock"];

	$rs = product_pagination(
		$pagination,
		$cat, 
		$name, 
		$maxPrice, 
		$minPrice, 
		$discount, 
		$stock
	);
	if(count($rs) > 0){
		http_response_code(200);
		echo json_encode($rs);
	}else{
		http_response_code(404);
		echo json_encode("Not found");
	}

?>