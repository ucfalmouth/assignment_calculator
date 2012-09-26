<?php
//Start session
	session_start();
	//Include database connection details
	require_once('config/config.php');
	//Array to store validation errors
	$errmsg_arr = array();
	//Validation error flag
	$errflag = false;
	//Connect to mysql server
	//$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	if ($link->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
	}
?>