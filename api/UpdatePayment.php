<?php
    include "../conn.php";
    
    $order=$_REQUEST['order'];
    $payment=$_REQUEST['payment'];
    $status=$_REQUEST['status'];
    $paidtime=$_REQUEST['paidtime'];
    
    $sql="UPDATE transaction SET payment_id='$payment',status='$status',paid_time='$paidtime' WHERE order_id='$order'";
    if(mysqli_query($conn,$sql))
        {
            // $jsonresponse ='{ "id": "'.$orderid.'","amount":'.$orderAmount.',"status":"'.$orderStatus.'" }';
            // echo $jsonresponse;
            
            $sql="SELECT * FROM transaction WHERE order_id='$order'";
            $result=$conn->query($sql);
				
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {    
                    $tid=$row["transaction_id"];  
                    $enroll=$row['enrollment']; 
                    $event=$row['event_id'];     
                }
                $sql="INSERT INTO event_registration(enrollment,transaction_id,event_id) VALUES ('$enroll','$tid','$event')";
                if(mysqli_query($conn,$sql))
                {
                    echo "Payment Successful..";
                }
                else
                {
                    echo "Error".$sql."<br>".mysqli_error($conn);
                }
            }
        }
        else
        {
            echo "Error".$sql."<br>".mysqli_error($conn);
        }
        mysqli_close($conn);
?>