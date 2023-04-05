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

<html>
	<head>
		<title>Login Page</title>
	</head>
	
	<body>
		<form align="center" method="post">
			<h1>Login</h1>
			
			<input type="text" name="username" placeholder="Enter Username" required><br><br>
			<input type="password" name="password" placeholder="Enter Password" required><br><br>
			
			<?php
				if(isset($_GET["error"]))
				{
			?>
				<p class="error">
                <?php
					echo $_GET["error"];
				?>
				</p>
			<?php
				}
			?>
			
			<button type="submit" name="submitinfo">
				Login
			</button>
		</form>
	</body>
</html>