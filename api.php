<?php
	$req = $_SERVER["REQUEST_URI"];

	require_once("config/config.php");
	require_once("config/connection.php");

	$action = substr($req, strrpos($req, '/') + 1);
	$model = substr($req, 0, strrpos($req, '/'));
	$model = substr($model, strrpos($model, '/') + 1);

	/*
	echo "<br/>" . $action;
	echo "<br/>" . $model;
	*/

	switch($model){
		case "user":{
			switch($action){
				case "login":{
					require_once("models/user/login.php");
					break;
				}
				case "logout":{
					require_once("models/user/logout.php");
					break;
				}
			}
			break;
		}
		case "product":{
			switch($action){
				case "search":{
					require_once("models/product/search.php");
					break;
				}
			}
			break;
		}
		default:{
			echo("default");
			break;
		}
	}
?>