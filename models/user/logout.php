<?php
	session_start();

	user_logout();

	header("Location: http://" . BASE_HREF . "/home");
	exit;
?>