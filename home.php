<html>
	<head>
		<title>Home Page</title>
	</head>
	
	<body align="center">
		<h1>Home Page</h1>
		
		<b>
		<?php
			include "controller.php";
			session_start();

			if(!isset($_SESSION['username']))
			{
				header("Location:login.php");
				exit();
			}

			echo "Welcome ".$_SESSION['username'];
			
		?></b>
		<br><br>
		
		<a href="event/<?php echo $file_event_view; ?>">
			<button>View Events</button>
		</a>

		<a href="event/<?php echo $file_event_addform; ?>">
			<button>Add Event</button>
        </a>

		<a href="<?php echo $file_userRegisterInfo; ?>">
			<button>User Registration Information</button>
		</a>

		<a href="<?php echo $file_user_info; ?>">
			<button>User Information</button>
		</a>

		<a href="<?php echo $file_logout; ?>">
			<button>Logout</button>
		</a>
	</body>
</html>


