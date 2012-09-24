<?php
//Start session
	session_start();
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

//Sanitize the POST values
	$email = clean($_POST['email']);
	$date1 = clean($_POST['date2']);
	$date2 = clean($_POST['date1']);
	$date3 = clean($_POST['date3']);
	$date4 = clean($_POST['date4']);
	$date5 = clean($_POST['date5']);
	
	srand ((double) microtime( )*10000000);
	$user_no = rand( );

	//Create INSERT query
	$qry = "INSERT INTO user(email) VALUES('$email')";
	$result = @mysql_query($qry);
	
	$qry = "INSERT INTO task(task, date, user_no) VALUES('Planning','$date1','$user_no')";
	$result = @mysql_query($qry);
	
	$qry = "INSERT INTO task(task, date, user_no) VALUES('Research','$date2','$user_no')";
	$result = @mysql_query($qry);
	
	$qry = "INSERT INTO task(task, date, user_no) VALUES('Organising','$date3','$user_no')";
	$result = @mysql_query($qry);
	
	$qry = "INSERT INTO task(task, date, user_no) VALUES('Written Report','$date4','$user_no')";
	$result = @mysql_query($qry);
	
	$qry = "INSERT INTO task(task, date, user_no) VALUES('Final Report','$date5','$user_no')";
	$result = @mysql_query($qry);
	
	
		
	//Check whether the query was successful or not
if($result) { 
header('location: test.php');
		exit();
	}else {
		die("Query failed");
	}
?>