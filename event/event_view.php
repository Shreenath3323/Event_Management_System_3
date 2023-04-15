<?php
    declare(strict_types=1);
    session_start();
    if(!isset($_SESSION['username']))
    {
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
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
			$url = "https://";   
		else  
			$url = "http://";   
		// Append the host(domain name, ip) to the URL.   
		$url.= $_SERVER['HTTP_HOST'];   
		
		// Append the requested resource location to the URL   
		$url.= $_SERVER['REQUEST_URI'];    
		
		//echo $url;
		$redirec_url = strstr($url, 'event_management', true) . 'event_management';
		$redirec_url=$redirec_url."/api/RegisterEvent.php?event_id=".$event_id;
        $qrcode = (new QRCode($options))->render($redirec_url);
		$src=$qrcode;
        return $src;
    }

?>
<html>
	<head>
	</head>

	<body>   
        <a href="../<?php echo $file_home ?>"><button>Back</button></a><br>

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
        $sql="SELECT * FROM event";
        $result=$conn->query($sql);
        
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            
			{
				?>
				<tr>
						<td><?php echo $row["id"] ?></td>
						<td><?php echo $row["event_name"] ?></td>
						<td><?php echo $row["event_description"] ?></td>
						<td><?php echo $row["event_date"] ?></td>
						<td> <img src=<?php echo $row["event_photo_link"] ?> width=100px height=100px></td>
						<td><?php echo $row["event_fees"] ?></td>
						<td><?php echo $row["modifiedBy"] ?></td>
					 	<?php $src=qr_code($row["id"]) ?>
						<td><a href="<?php echo $src ?>" download="<?php echo $row["event_name"] ?>"><img src="<?php echo $src ?>" width=100px height=100px></a></td>

					</tr>

				<?php
			} 
        }
        else
        {
            echo "0 result";
        }                          
		?>
		</table>
	</body>
</html>