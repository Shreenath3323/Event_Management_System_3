<html>
	<head>
		<title>Login Page</title>
	</head>
	
	<body>
		<form align="center" action="login.php" method="post">
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