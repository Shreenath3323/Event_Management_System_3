<?php
    session_start();
	include "../conn.php";
    require 'vendor/autoload.php';
    use Cloudinary\Configuration\Configuration;
    use Cloudinary\Api\Upload\UploadApi;
    Configuration::instance([
        'cloud' => [
          'cloud_name' => 'dceoof2si', 
          'api_key' => '311111991641997', 
          'api_secret' => '_b8lJpu-t0Kp5x3BEW3IZyeeb-Y'],
        'url' => [
          'secure' => true]]);

    if(isset($_POST['submit']))
    {
    
        $b=$_POST['event_name'];
        $c=$_POST['event_description'];
        $d=$_POST['event_date'];   
        $f=$_POST['event_fees'];
        $g=$_SESSION['username'];
        $result=(new UploadApi())->upload($_FILES['file']['tmp_name']);
        $imageurl=$result['secure_url'];

        $sql="INSERT INTO event(event_name,event_description,event_date,event_photo_link,event_fees,modifiedBy) VALUES ('$b','$c','$d','$imageurl','$f','$g')";
        
        if(mysqli_query($conn,$sql))
        {
            echo "Record inserted successfully...";
            header("Location:event_view.php");
        }
        else
        {
            echo "Error".$sql."<br>".mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>

<html>
    <head>
        <title>Event adding form</title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data">
            <h1 align="center">Add New Event</h1>

            <!-- <input type="number" name="id" required></td>-> -->
		    <input type="text" name="event_name" placeholder="Enter Event Name" required>
		    <input type="text" name="event_description" placeholder="Enter Event Description" required>
			<input type="date" name="event_date" placeholder="Enter Event Date" required>
			<input type="file" name="file" id="file" accept="images/*" required>
			<input type="number" name="event_fees" placeholder="Enter Event Fees" required>
            			
            <button type="submit" name="submit">
				Add
		    </button>
        </form>
    </body>
</html>