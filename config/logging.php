<?php
	$file = fopen(BASE_FILE . "/data/log.txt", "a");

	$string = substr($_SERVER['REDIRECT_URL'], strlen(SUBFOLDER)) . "\t" . date("d.m.Y H:i:s") . "\t" . $_SERVER['REMOTE_ADDR'] . "\n";

	fwrite($file, $string);

	fclose($file);
?>