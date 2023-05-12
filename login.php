<?php
session_start();
include "conn.php";
include "controller.php";

if (isset($_POST['submitinfo'])) {
	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['username']);
	$pass = validate($_POST['password']);
	$uname=stripcslashes($uname);
	$pass=stripcslashes($pass);
	$uname=mysqli_real_escape_string($conn, $uname);  
	$pass=mysqli_real_escape_string($conn, $pass);

	$sql = "SELECT * FROM credential WHERE username='$uname' AND password='$pass'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) === 1) {
		$_SESSION['username'] = $uname; //$row['username'];
		header("Location:$file_home");
		exit();
	} else {
		header("Location:$file_login?error=Incorrect Username or password");
		exit();
	}
}
?>

<html>

<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container card">
		<div class="row">
			<div class="col-sm-4">
				<!-- <img src="images\Artboard 1.png" height="400" width="400" class="img1" /> -->
			</div>
			<div class="col-sm-4">
				<div class="signinFrm">
					<form method="post" class="form">
						<h1 class="title">LOGIN</h1>
						<img src="images/logo2.avif" style="width:50%;border-radius: 54%;margin: 0% 24% 4% 23%;" />
						<div class="inputContainer">
							<input type="text" name="username" class="input" placeholder="a"
								required>
							<label for="" class="label" style="color:black;">Username</label>
						</div>
						<div class="inputContainer">
							<input type="password" name="password" class="input" placeholder="a"
								required>
							<label for="" class="label" style="color:black;">Password</label>
						</div>

						<br>
						<?php
						if (isset($_GET["error"])) {
							?>
							<p class="error">
								<?php
								echo $_GET["error"];
								?>
							</p>
							<?php
						}
						?>
						<button type="submit" name="submitinfo" class="button">
							<span>
								Login
							</span>
						</button>

					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>