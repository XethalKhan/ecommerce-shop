<?php

try{
	$conn = new PDO('mysql:host='.HOST.';dbname='.DATABASE, UNAUTHORIZED_USER, UNAUTHORIZED_PASS);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}catch(Exception $e){
	http_response_code(500);
	echo $e;
	die();
}

?>