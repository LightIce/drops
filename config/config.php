<?php

	$db_host = 'localhost';
	$db_username = 'root';
	$db_password = '';
	$db_database = 'DB_DROPS';
	
	@$db = new mysqli($host, $db_username, $db_password, $db_database);
	if (mysqli_connect_error()) {
	 	echo "Connect to database unsuccess.";
	 	exit;
	}
	$db->set_charset("utf8");

	function SqlGuard($input, $db) {
		if (get_magic_quotes_gpc()) {
			$input = stripcslashes($input);
		}
		$input = strip_tags($input);
		$input = $db->real_escape_string(trim($input));
		return $input;
	}


?>