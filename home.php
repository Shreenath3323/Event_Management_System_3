<html>
	<head>
		<title>Home Page</title>
	</head>
	
	<body align="center">
		<h1>Home Page</h1>
		
		<b>
		<?php
			session_start();
			echo "Welcome ".$_SESSION['username'];
			
		?></b>
		<br><br>
		
		<a href="event_view.php">
			<button>View Events</button>
		</a>
		<a href="event_manage.php">
			<button>Manage Events</button>
		</a>

		<a href="logout.php">
			<button>Logout</button>
		</a>
	</body>
</html>


