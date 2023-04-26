<?php
include "controller.php";
session_start();
if (!isset($_SESSION['username'])) {
	header("Location:login.php");
	exit();
}
?>
<html>

<head>
	<title>Home Page</title>
	<link rel="stylesheet" href="css/homePage.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="js/homePage.js"></script>
</head>

<body>
	<div class='dashboard'>
		<div class="dashboard-nav">
			<header>
				<a href="home.php" class="brand-logo">
					<i class="fa fa-home"></i>
					<span>Admin Panel</span>
				</a>
			</header>
			<nav class="dashboard-nav-list">
				<a href="event/<?php echo $file_event_view; ?>" class="dashboard-nav-item">
					<i class="fas fa-info"></i>
					Events
				</a>
				<a href="event/<?php echo $file_event_addform; ?>" class="dashboard-nav-item">
					<i class="fa fa-quote-left"></i>
					Add Event
				</a>
				<a href="<?php echo $file_userRegisterInfo; ?>" class="dashboard-nav-item">
					<i class="fa fa-id-card"></i>
					Registrations
				</a>
				<a href="<?php echo $file_user_info; ?>" class="dashboard-nav-item">
					<i class="fa fa-users"></i>
					Students
				</a>
				<a href="<?php echo $file_logout; ?>" class="dashboard-nav-item">
					<i class="fa fa-power-off"></i>
					Log Out
				</a>
			</nav>
		</div>
		<div class='dashboard-app'>
			<header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
			</header>
			<div class='dashboard-content'>
				<div class='container'>
					<div class='card'>
						<div class='card-header'>
							<h1>Home Page</h1>
						</div>
						<div class='card-body'>
							<p>
								<?php echo "Welcome " . $_SESSION['username']; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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