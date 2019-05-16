<?php
	define("SUBFOLDER", substr($_SERVER["SCRIPT_NAME"], 0, strrpos($_SERVER["SCRIPT_NAME"], '/')));
	define("BASE_URL", $_SERVER["DOCUMENT_ROOT"] . SUBFOLDER);
	define("HREF", $_SERVER["SERVER_ADDR"] . SUBFOLDER);
	define("DATABASE", env("DATABASE"));
	define("HOST", env("HOST"));
	define("UNAUTHORIZED_USER", env("UNAUTHORIZED_USER"));
	define("UNAUTHORIZED_PASS", env("UNAUTHORIZED_PASS"));

	function env($find){
		$envConf = file(BASE_URL . "/config/.env");
		$val = "";
		foreach($envConf as $row){
			$data = explode("=", trim($row));
			if($data[0] == $find){
				$val = $data[1];
			}
		}
		return $val;
	}

?>