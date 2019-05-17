<?php
	session_start();
	session_unset();
	session_destroy();
	header("Location: http://" . BASE_HREF . "/home");
	exit;
?>