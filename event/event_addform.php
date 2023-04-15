<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location:../login.php");
        exit();
    }
	include "../conn.php";
    include "../controller.php";

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
        $event_name=$_POST['event_name'];
        $event_description=$_POST['event_description'];
        $event_date=$_POST['event_date'];   
        $event_fees=$_POST['event_fees'];
        $modifiedby=$_SESSION['username'];
        $result=(new UploadApi())->upload($_FILES['file']['tmp_name']);
        $imageurl=$result['secure_url'];

        $sql="INSERT INTO event(event_name,event_description,event_date,event_photo_link,event_fees,modifiedBy) VALUES ('$event_name','$event_description','$event_date','$imageurl','$event_fees','$modifiedby')";
        
        if(mysqli_query($conn,$sql))
        {
            header("Location:$file_event_view");
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
    <a href="../<?php echo $file_home ?>"><button>Back</button></a><br>

        <form method="POST" enctype="multipart/form-data">
            <h1 align="center">Add New Event</h1>

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