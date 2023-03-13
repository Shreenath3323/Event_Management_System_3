<?php
	session_start();
	include "conn.php";
	
	if(isset($_POST['submitinfo']))
	{
		function validate($data)
		{
			$data=trim($data);
			$data=stripslashes($data);
			$data=htmlspecialchars($data);
			return $data;
		}
		
		$uname=validate($_POST['username']);
		$pass=validate($_POST['password']);
		
		$sql="SELECT * FROM credential WHERE username='$uname' AND password='$pass'";
		$result=mysqli_query($conn,$sql);
			
		if(mysqli_num_rows($result) === 1)
		{
			$_SESSION['username']=$uname;//$row['username'];
			header("Location:home.php");
			exit();			
		}
		else
		{
			header("Location:index.php?error=Incorrect Username or password");
			exit();
		}		
	}
?>