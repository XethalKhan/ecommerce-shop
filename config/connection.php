<?php

try{
	$user = "";
	$pass = "";
	if(isset($_SESSION["gid"])){
		if($_SESSION["gid"] == 0){
			$user = CUSTOMER_USER;
			$pass = CUSTOMER_PASS;
		}else if($_SESSION["gid"] == 1){
			$user = ADMIN_USER;
			$pass = ADMIN_PASS;
		}else{
			$user = UNAUTHORIZED_USER;
			$pass = UNAUTHORIZED_PASS;
		}
	}else{
		$user = UNAUTHORIZED_USER;
		$pass = UNAUTHORIZED_PASS;
	}
	$conn = new PDO('mysql:host='.HOST.';dbname='.DATABASE.';charset=utf8', UNAUTHORIZED_USER, UNAUTHORIZED_PASS);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}catch(Exception $e){
	http_response_code(500);
	echo $e;
	die();
}

?>