<?php
	if(LOG=='on'){
		$name = date("dmy");

		//<LOGGING ACCESS>
		$file = fopen(BASE_FILE . "/data/session/" . $name . ".txt", "a");

		$string = 
			substr($_SERVER['REDIRECT_URL'], strlen(SUBFOLDER)) . "\t" .
			date("h:i:s") . "\t" . 
			(isset($_SESSION["uid"]) ? $_SESSION["uid"] : "UNAUTHENTICATED") . "\t" . 
			(isset($_COOKIE["session-id"]) ? $_COOKIE["session-id"] : "UNAUTHENTICATED") . "\t" . 
			$_SERVER['REMOTE_ADDR'] . ":" . $_SERVER['REMOTE_PORT'] . "\n";

		fwrite($file, $string);

		fclose($file);
		//</LOGGING ACCESS>
	}
?>