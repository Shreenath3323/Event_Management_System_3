<?php
	session_start();
	include "conn.php";
	
	//$a=$_POST['id'];
	$b=$_POST['event_name'];
	$c=$_POST['event_description'];
	$d=$_POST['event_date'];
	$e=$_POST['event_photo'];
	$f=$_POST['event_fees'];
	$g=$_SESSION['username'];
	
	$sql="INSERT INTO event(event_name,event_description,event_date,event_photo,event_fees,modifiedBy) VALUES ('$b','$c','$d','$e','$f','$g')";
	
	if(mysqli_query($conn,$sql))
	{
		echo "Record inserted successfully...";
		header("Location:event_view.php");
	}
	else
	{
		echo "Error".$sql."<br>".mysqli_error($conn);
	}
	mysqli_close($conn);		
?>