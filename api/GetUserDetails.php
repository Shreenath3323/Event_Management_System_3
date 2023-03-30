<?php
    include "../conn.php";

    $enroll=$_GET['enroll'];

    $sql="SELECT * FROM user WHERE enrollment='$enroll' ";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {
            $enrollment= $row["enrollment"];
            $first_name= $row["first_name"];
            $last_name= $row["last_name"];
            $gender= $row["gender"];
            $email= $row["email"];
            $mobile= $row["mobile"];
            $department= $row["department"];
            $course= $row["course"];
        }
        $detail_json='{ "enrollment": "'.$enrollment.'","fname":"'.$first_name.'","lname":"'.$last_name.'","gender":"'.$gender.'","mobile":"'.$mobile.'","email":"'.$email.'" }';
        echo $detail_json;
    }
    else
    {
        echo "Error".$sql."<br>".mysqli_error($conn);
    }
    mysqli_close($conn);
?>