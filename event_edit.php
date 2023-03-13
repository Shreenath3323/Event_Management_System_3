<?php
    include "conn.php";
    
    $id=$_GET['id'];
    $query=mysqli_query($conn,"select * from event where id='$id'");
    $row=mysqli_fetch_array($query);
?>

<html>
    <head>
        <title>Edit form</title>
    </head>
    <body>
        <h1>Edit Data</h1>
        <form method="POST" action="event_update.php?id=
            <?php
                echo $id;
            ?>
        ">
            <label>Event Name</label>
            <input type="text" name="event_name" placeholder="Enter Event Name" required value="
                <?php
                    echo $row['event_name'];
                ?>
            "><br>
            <label>Event Description</label>
            <input type="text" name="event_description" placeholder="Enter Event Description" required value="
                <?php
                    echo $row['event_description'];
                ?>
            "><br>
            <label>Event Date</label>
            <input type="date" name="event_date" placeholder="Enter Event Date" required value="
                <?php
                    echo $row['event_date'];
                ?>
            "><br>
            <label>Event Photo</label>
            <input type="file" name="event_photo" placeholder="Insert Event Photo" required value="
                <?php
                    echo $row['event_photo'];
                ?>
            "><br>
            <label>Event Fees</label>
            <input type="number" name="event_fees" placeholder="Enter Event Fees" required value="
                <?php
                    echo $row['event_fees'];
                ?>
            "><br>
            
            <button type="submit" name="submit">
                Edit
            </button>
        </form>
    </body>
</html>