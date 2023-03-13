<?php
	include "conn.php";
	
	$id=$_REQUEST['id'];
	$query="DELETE FROM event WHERE id=$id";
	$result=$conn->query($query);
	if($result)
	{
		echo "Deleted..";
	}
	else
	{
		echo "Error";
	} 
    header("Location:event_view.php");
?>