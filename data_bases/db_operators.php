<?php

function create_connection($serverName,
						   $DBUserName,
						   $DBUserPassword,
						   $DBName=NULL,
						   $check_connection=False) {
	if (!$DBName) {
		$connection = new mysqli($serverName, $DBUserName, $DBUserPassword);
		
		if ($check_connection) {
			if ($connection->connect_error) {
				die("<span style='color:red; font-weight: bold'>Could not connect to server.</span> Errorea: " . mysqli_connect_error());	
			}
			else {
				echo ("<span style='color:green; font-weight: bold'>Successfully connected to server.</span>");
			}
		}
	}
	
	else {
		$connection = new mysqli($serverName, $DBUserName, $DBUserPassword, $DBName);
		
		if ($check_connection) {
			if ($connection->connect_error) {
				die("<span style='color:red; font-weight: bold'>Could not connect to database.</span> Errorea: " . mysqli_connect_error());	
			}
			else {
				echo ("<span style='color:green; font-weight: bold'>Successfully connected to database.</span>");
			}
		}
	}
	return $connection;
}

function close_connection($connection) {
	$connection -> close();
}

function create_database($connection, $dbname) {
	$createdbsyn = "CREATE DATABASE $dbname";
	$createdbcomm = generic_mysql_command($connection, $createdbsyn);
	return $createdbcomm;
}

?>
