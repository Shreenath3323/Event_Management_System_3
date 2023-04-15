<?php
	session_start();
	include "conn.php";
	include "controller.php";

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
			header("Location:$file_home");
			exit();			
		}
		else
		{
			header("Location:$file_login?error=Incorrect Username or password");
			exit();
		}		
	}
?>

<html>
	<head>
	<meta charset="UTF-8">
		<title>Login Page</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"><link rel="stylesheet" href="./style.css">

	</head>
	
	<body>
	<form method="post">
	<div class="box-form">
	<div class="left">
		<div class="overlay">
		<h1>Hello Admin</h1>
		<p>Welcome to Login Page.</p>
		</div>
	</div>
	<div class="right">
		<h5><strong>Login</strong></h5>
		<div class="inputs">
			<input type="text" name="username" placeholder="Enter Username" required><br>
			<input type="password" name="password" placeholder="Enter Password" required><br>

		</div>
			
			<br><br>
			
			
			<br>
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
			
	</div>
	
</div>
</form>
	</body>
</html>