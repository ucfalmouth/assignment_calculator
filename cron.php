<?php
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

$date = date("d-m-y");

	//Create query
    $qry="SELECT * 
    FROM user, task
	WHERE task.date = '$date'";
	$result=mysql_query($qry);

while($row = mysql_fetch_array($result))
  {

$email = $row['email'];
$task = $row['task'];	    

	  
$subject = "$task is due today"; 
$message = " Hey There, Just wanted to let you no that $task is day today."; 

mail($email, $subject, $message, "From: aluluvo.co.uk auto<auto@aluluvo.co.uk>\n 
X-Mailer: PHP/" . phpversion()); 
  }
?>




