<?php
session_start();
if (!isset($_SESSION['username'])) {
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
        'api_secret' => '_b8lJpu-t0Kp5x3BEW3IZyeeb-Y'
    ],
    'url' => [
        'secure' => true
    ]
]);

if (isset($_POST['submit'])) {
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $event_fees = $_POST['event_fees'];
    $modifiedby = $_SESSION['username'];
    $result = (new UploadApi())->upload($_FILES['file']['tmp_name']);
    $imageurl = $result['secure_url'];

    $sql = "INSERT INTO event(event_name,event_description,event_date,event_photo_link,event_fees,modifiedBy) VALUES ('$event_name','$event_description','$event_date','$imageurl','$event_fees','$modifiedby')";

    if (mysqli_query($conn, $sql)) {
        
        header("Location:$file_event_view");
    } else {
        echo "Error" . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

<html>

<head>
    <title>Event adding form</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/button.css" />
    <link rel="stylesheet" href="../css/add_event.css">
</head>

<body>
    <div class="addEvent">
        <div class="signupFrm">
            <form method="POST" enctype="multipart/form-data" class="form">
                <h1 class="title">Add New Event</h1>

                <div class="inputContainer">
                    <input type="text" id="event_name" name="event_name" placeholder="a" class="input" required>
                    <label for="event_name" class="label">Event Name</label>
                </div>
                <div class="inputContainer">
                    <input type="text" id="event_description" name="event_description" placeholder="a" class="input"
                        required>
                    <label for="event_description" class="label">Event Description</label>
                </div>

                <label for="event_date" style="color: floralwhite">Event Date</label>
                <div class="inputContainer">
                    <input type="date" id="event_date" name="event_date" class="input" required>
                </div>

                <label for="file" style="color: floralwhite">Choose a Image</label>
                <div class="inputContainer">
                    <input type="file" id="file" name="file" accept="images/*" class="input" required>
                </div>

                <div class="inputContainer">
                    <input type="number" id="event_fees" name="event_fees" placeholder="a" class="input" required>
                    <label for="event_fees" class="label">Event Fees</label>
                </div>

                <button type="submit" name="submit" class="button">
                <span>
                 Add Event
</span>
                </button><br>

                <!-- <a href="../<?php //echo $file_home ?>"><button class="btn"><i class="fa fa-home"></i>
                        Previous</button></a><br> -->
                        <a href="../<?php echo $file_home ?>"class="ab"><i class="fa fa-home"></i> Previous</a>
            </form>
</body>

</html>