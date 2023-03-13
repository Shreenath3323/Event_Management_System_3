<?php
	$sname="localhost";
	$uname="root";
	$pass="3323";
	$dbname="event_management";
	
	$conn=mysqli_connect($sname,$uname,$pass,$dbname);
	
	if(!$conn)
	{
		die("Connection failed".mysqli_connect_error());
	}
	echo "Connected Successfully..";
?>