<?php
	try {
		// Read the file "dbconfig" for database connection parameters
		//
		$config = file_get_contents("dbconfig");
		preg_match('/^user=(.+)$/m', $config, $m);
		$user = $m[1];
		preg_match('/^host=(.+)$/m', $config, $m);
		$host = $m[1];
		preg_match('/^dbname=(.+)$/m', $config, $m);
		$dbname = $m[1];
		preg_match('/^password=(.+)$/m', $config, $m);
		$password = $m[1];
	} catch (Exception $e) {
		die("Error (Database Configuration): " . $e->getMessage());
	}
	try {
		// Initiate database connection
		//
		$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	} catch (PDOException $e) {
		die("Error (Database Connection): " . $e->getMessage());
	}

?>