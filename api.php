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
		case "order":{
			switch($action){
				case "search":{
					require_once("models/order/search.php");
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
		case "survey":{
			switch($action){
				case "answer":{
					require_once("models/survey/answer.php");
					break;
				}
			}
			break;
		}
		case "ticket":{
			switch($action){
				case "search":{
					require_once("models/ticket/search.php");
					break;
				}
			}
			break;
		}
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
				case "search":{
					require_once("models/user/search.php");
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