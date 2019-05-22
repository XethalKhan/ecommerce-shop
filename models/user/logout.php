<?php
	session_start();
	session_unset();
	session_destroy();
	setcookie("session-id", null, -1);
	header("Location: http://" . BASE_HREF . "/home");
	exit;
?>