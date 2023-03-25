<?php
	declare(strict_types=1);
	use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;
    require_once('vendor/autoload.php');

	include "../conn.php";

	function qr_code($event_name)
    {
        $options = new QROptions(
            [
              'eccLevel' => QRCode::ECC_L,
              'outputType' => QRCode::OUTPUT_MARKUP_SVG,
              'version' => 5,
            ]
        );
  
        $qrcode = (new QRCode($options))->render($event_name);
		$src=$qrcode;
        return $src;
    }
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
				<th>Event_photo_link</th>
				<th>Event_fees</th>
				<th>Modify_by</th>
				<th>QRcode</th>
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
						echo "<td> <img src='".$row["event_photo_link"]."' width=100px height=100px></td>";
						echo "<td>".$row["event_fees"]."</td>";
						echo "<td>".$row["modifiedBy"]."</td>";
						$src=qr_code($row["event_name"]);
						echo "<td>"."<img src=".$src." width=100px height=100px>"."</td>";
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