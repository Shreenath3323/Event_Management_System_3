<?php
       include "../conn.php";

       $lname = $_REQUEST['lname'];
       $sql = "SELECT event_registration.id ,event.event_name,event.event_date,event.event_fees,";
       $sql = $sql . "event_registration.enrollment,user.first_name,user.last_name,user.department,user.course,";
       $sql = $sql . "transaction.transaction_id,transaction.payment_id,transaction.status,transaction.date,transaction.paid_time ";
       $sql = $sql . "FROM event_registration INNER JOIN user ";
       $sql = $sql . "on event_registration.enrollment=user.enrollment ";
       $sql = $sql . "inner join event on event_registration.event_id=event.id ";
       $sql = $sql . "INNER JOIN transaction ON event_registration.transaction_id=transaction.transaction_id where user.last_name LIKE '$lname%'";
       $result = $conn->query($sql);
       while ($row = $result->fetch_assoc()) {
              $res1[] = $row;
       }
       print(json_encode($res1));
       mysqli_close($conn);
?>