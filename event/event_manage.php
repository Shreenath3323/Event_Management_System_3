<?php
	session_start();
	include "../conn.php";
?>

<html>
	<head>
		<title>Event Manage page</title>
	</head>
	
	<body>
		<h1>Manage Events</h1>

		<a href="event_addform.php">
			<button>Add Event</button>
        </a><br><br>	
		
		<table border="1">
			<tr>
				<th>Id</th>
				<th>Event_name</th>
				<th>Event_description</th>
				<th>Event_date</th>
				<th>Event_photo_link</th>
				<th>Event_fees</th>
				<th>Modify_by</th>
				<th>Edit</th>
			</tr>
			
			<?php
				$sql="SELECT * from event";
				$result=$conn->query($sql);
				
				if($result->num_rows>0)
				{
					while($row=$result->fetch_assoc())
					{
						echo "<tr>";
						echo "<td>".$row["id"]."</td>";
						echo "<td>".$row["event_name"]."</td>";
						echo "<td>".$row["event_description"]."</td>";
						echo "<td>".$row["event_date"]."</td>";
						echo "<td>".$row["event_photo_link"]."</td>";
						echo "<td>".$row["event_fees"]."</td>";
						echo "<td>".$row["modifiedBy"]."</td>";
			?>
						<td>
							<a href="event_edit.php?id=
								<?php
									echo $row['id'];
								?>
							">
								<button>Edit</button>
							</a>
						</td>
						
							<?php
								echo "</tr>";	
					}
					echo "</table>";
				}
				else
				{
					echo "0 result";
				}	
			?>
		</table>
	</body>
</html>