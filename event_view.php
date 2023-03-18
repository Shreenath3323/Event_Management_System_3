<?php
	include "conn.php";
?>

<html>
	<head>
		<title>Event view page</title>
	</head>
	
	<body>
		<h1>List of events</h1>
	
		<table border="1">
			<tr>
				<th>Id</th>
				<th>Event_name</th>
				<th>Event_description</th>
				<th>Event_date</th>
				<th>Event_photo</th>
				<th>Event_fees</th>
				<th>Modify_by</th>
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
						
						// // <img src="data:image/jpeg;charset=utf8;base64,
						// $aa=base64_encode($row['event_photo']);
						// // echo "<td>".$aa."</td>";
						// $bb=base64_decode($aa);
						// echo "<td>".'<img src='.$bb.' width=100px height=100px/>'."</td>";
						// // $ii=imageCreateFromString($bb);
						
						
						echo "<td>".'<img src="data:image/*;base64,'.base64_encode($row['event_photo']).'" width=100px height=100px/>'."</td>";					
						
						// echo "<td>".'<img src="data:image/png;charset=utf8;base64,'.base64_encode($row['event_photo']).'" width=100px height=100px/>'."</td>";
						echo "<td>"."<img src=".$row['event_photo']." width=100px height=100px>"."</td>";
						echo "<td>".$row["event_fees"]."</td>";
						echo "<td>".$row["modifiedBy"]."</td>";
					echo "</tr>";	
				}
				echo "</table>";
			}
			echo "0 result";	
		?>
		</table>
	</body>
</html>


