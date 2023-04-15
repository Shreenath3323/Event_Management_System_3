<?php
	include "conn.php";
    include "controller.php";
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location:login.php");
        exit();
    }
?>

<html>
	<head>
		<title>Event Manage page</title>
	</head>
	
	<body>
        <a href="<?php echo $file_home ?>"><button>Back</button></a><br>

		<h1>Registrations</h1>
	
		<table border="1">
        <tr>
            <th>Registration id</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Event Fees</th>
            <th>Enrollment</th>
            <th>First Name</th>
            <th>Last name</th>
            <th>Department</th>
            <th>Course</th>
            <th>Transaction Id</th>
            <th>Payment Id</th>
            <th>Status</th>
            <th>Payment Date</th>
            <th>Payment Time</th>
            
        </tr>
			
        <?php
            $sql="SELECT event_registration.id ,event.event_name,event.event_date,event.event_fees,";
            $sql=$sql. "event_registration.enrollment,user.first_name,user.last_name,user.department,user.course,";
            $sql=$sql. "transaction.transaction_id,transaction.payment_id,transaction.status,transaction.date,transaction.paid_time ";
            $sql=$sql. "FROM event_registration INNER JOIN user ";
            $sql=$sql. "on event_registration.enrollment=user.enrollment ";
            $sql=$sql. "inner join event on event_registration.event_id=event.id ";
            $sql=$sql."INNER JOIN transaction ON event_registration.transaction_id=transaction.transaction_id";
            $result=$conn->query($sql);
            
            if($result->num_rows>0)
            {
                while($row=$result->fetch_assoc())
                {?>
                    <tr>
                        <td><?php echo $row["id"] ?></td>
                        <td><?php echo $row["event_name"] ?></td>
                        <td><?php echo $row["event_date"] ?></td>
                        <td><?php echo $row["event_fees"] ?></td>
                        <td><?php echo $row["enrollment"] ?></td>
                        <td><?php echo $row["first_name"] ?></td>
                        <td><?php echo $row["last_name"] ?></td>
                        <td><?php echo $row["department"] ?></td>
                        <td><?php echo $row["course"] ?></td>
                        <td><?php echo $row["transaction_id"] ?></td>
                        <td><?php echo $row["payment_id"] ?></td>
                        <td><?php echo $row["status"] ?></td>
                        <td><?php echo $row["date"] ?></td>
                        <td><?php echo $row["paid_time"] ?></td>
                    </tr>       
                
                    <?php
                }	
            }
            else
            {
                echo "0 result";
            }	
        ?>
		</table>
	</body>
</html>