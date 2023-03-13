<?php
    include "conn.php";
    
    $id=$_REQUEST['id'];
    
    $a=$_POST['event_name'];
    $b=$_POST['event_description'];
    $c=$_POST['event_date'];
    $d=$_POST['event_photo'];
    $e=$_POST['event_fees'];
    
    mysqli_query($conn,"UPDATE event SET event_name='$a',event_description='$b',event_date='$c',event_photo='$d',event_fees='$e' WHERE id='$id'");  
    header('Location:event_view.php');
?>