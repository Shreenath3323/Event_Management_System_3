<?php
declare(strict_types=1);
session_start();
if (!isset($_SESSION['username'])) {
	header("Location:../login.php");
	exit();
}


use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require_once('vendor/autoload.php');

include "../conn.php";
include "../controller.php";

function qr_code($event_id)
{
	$options = new QROptions(
		[
			'eccLevel' => QRCode::ECC_L,
			'outputType' => QRCode::OUTPUT_MARKUP_SVG,
			'version' => 5,
		]
	);
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
		$url = "https://";
	else
		$url = "http://";
	// Append the host(domain name, ip) to the URL.   
	$url .= $_SERVER['HTTP_HOST'];

	// Append the requested resource location to the URL   
	$url .= $_SERVER['REQUEST_URI'];

	//echo $url;
	$redirec_url = strstr($url, 'event_management', true) . 'event_management';
	$redirec_url = $redirec_url . "/api/RegisterEvent.php?event_id=" . $event_id;
	$qrcode = (new QRCode($options))->render($redirec_url);
	$src = $qrcode;
	return $src;
}
?>

<html>
<head>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="../css/viewEvent.css">
	<link rel="stylesheet" href="../css/button.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script arc="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
</head>

<body class="bg-image">
<center><h1 class="text">View Events</h1></center>
    <div class="card">
        <div class="container">
	<table id="example" class="display cell-border tablefont " style="width:100%;">
		<thead>
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
		</thead>
		<tbody>

			<?php
			$result = mysqli_query($conn, "SELECT * FROM `event`");
			while ($row = mysqli_fetch_array($result)) {
				?>
				<tr>
					<td>
						<?php echo $row["id"] ?>
					</td>
					<td>
						<?php echo $row["event_name"] ?>
					</td>
					<td>
						<?php echo $row["event_description"] ?>
					</td>
					<td>
						<?php echo $row["event_date"] ?>
					</td>
					<td> <img src=<?php echo $row["event_photo_link"] ?> class="thumbnail" id="urlImg"></td>
					<td>
						<?php echo $row["event_fees"] ?>
					</td>
					<td>
						<?php echo $row["modifiedBy"] ?>
					</td>
					<?php $src = qr_code($row["id"]) ?>
					<td><a href="<?php echo $src ?>" download="<?php echo $row["event_name"] ?>"><img
								src="<?php echo $src ?>" class="thumbnail" id="urlImg"></a></td>

				</tr>

				<?php
			}
			?>
		</tbody>
	</table>
	</div>
	</div>
	<script>
		$(document).ready(function () {
			$('#example').DataTable({
				pagingType: 'full_numbers',
				lengthMenu: [
					[5, 10, 25, 50, -1],
					[5, 10, 25, 50, 'All'],
				],
			});
		});
	</script>
	<a href="../<?php echo $file_home ?>"><button class="btn"><i class="fa fa-home"></i> Previous</button></a><br>
</body>

</html>