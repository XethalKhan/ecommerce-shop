<?php
	session_start();

	$stmt = $conn->prepare("DELETE FROM session WHERE uid = ? AND hash = ?");
	$stmt->execute([$_SESSION["uid"], $_COOKIE["session-id"]]);

	session_unset();
	session_destroy();
	setcookie("session-id", null, -1, SUBFOLDER . "/");
	header("Location: http://" . BASE_HREF . "/home");
	exit;
?>