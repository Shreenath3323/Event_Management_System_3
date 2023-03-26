<?php
    // data="enroll="+123+"&fname="+ssa+"&lname="+oop+"&gender="+male+"&email="+abc @gmail.com+"&mob="+mobile+"&dept="+department+"&course="+course;
    include "../conn.php";
    
    $enroll=$_REQUEST['enroll'];
    $event=$_REQUEST['event'];
    
    $sql="select * FROM event_registration where enrollment='$enroll' and event_id=$event";

    $result=$conn->query($sql);
				
    if($result->num_rows>0)
    {
        echo  "true";
    }
    else
    {
        echo "false";   
    }
    
    
?>