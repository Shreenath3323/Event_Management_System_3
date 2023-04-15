<?php
	$sname="eventmanagements.c7vgryleb9mf.us-east-1.rds.amazonaws.com";
	$uname="admin";
	$pass="qJ3b7sd8";
	$dbname="event_management";
	
	$conn=mysqli_connect($sname,$uname,$pass,$dbname);
	
	if(!$conn)
	{
		die("Connection failed".mysqli_connect_error());
	}
	//echo "Connected Successfully..";
?>