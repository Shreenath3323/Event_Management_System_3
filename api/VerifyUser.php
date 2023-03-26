<?php
    // data="enroll="+123+"&fname="+ssa+"&lname="+oop+"&gender="+male+"&email="+abc @gmail.com+"&mob="+mobile+"&dept="+department+"&course="+course;
    include "../conn.php";
    
    $enroll=$_REQUEST['enroll'];
    $fname=$_REQUEST['fname'];
    $lname=$_REQUEST['lname'];
    $gender=$_REQUEST['gender'];
    $email=$_REQUEST['email'];
    $mob=$_REQUEST['mob'];
    $dept=$_REQUEST['dept'];
    $course=$_REQUEST['course'];
    
    $sql="select * FROM user where enrollment='$enroll'";

    $result=$conn->query($sql);
				
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {            
           echo $row['enrollment'].$row['first_name'].$row['last_name'].$row['gender'].$row['email'].$row['mobile'].$row['department'].$row['course']; 
        }
    }
    else
    {
        $sql_insert="INSERT INTO user VALUES('$enroll','$fname','$lname','$gender','$email','$mob','$dept','$course')";

        if(mysqli_query($conn,$sql_insert))
        {
            echo "Record inserted successfully...";
        }
        else
        {
            echo "Error".$sql_insert."<br>".mysqli_error($conn);
        }
        
    }
    
    
?>