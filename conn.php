<?php
	$sname="eventmanagements.c7vgryleb9mf.us-east-1.rds.amazonaws.com";
	$uname="admin";
	$pass="sLya3us0ub1a_i1a";
	$dbname="event_management";
	
	$conn=mysqli_connect($sname,$uname,$pass,$dbname);
	
	if(!$conn)
	{
		die("Connection failed".mysqli_connect_error());
	}
	//echo "Connected Successfully..";
	
?>