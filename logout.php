<?php
	session_start();
	if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name']) || !isset($_SESSION['session_id'])) {
		exit;
	}
	else {
		$_SESSION = array();
		session_destroy();
	}
	header("Location: index.php");
?>