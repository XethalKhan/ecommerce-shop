<?php
	session_start();
	session_unset();
	session_destroy();
	setcookie("session-id", null, -1, SUBFOLDER . "/");
	header("Location: http://" . BASE_HREF . "/home");
	exit;
?>