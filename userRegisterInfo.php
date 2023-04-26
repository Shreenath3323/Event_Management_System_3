<?php
include "conn.php";
include "controller.php";
session_start();
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
    exit();
}
?>

<html>

<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="css/registration.css">
    <link rel="stylesheet" href="css/button.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script arc="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
</head>

<body class="bg-image">

    <center>
        <h1 class="text">Registrations</h1>
    </center>
    <div class="card">
        <div class="container">
            <table id="example" class="display cell-border tablefont " style="width:10%;">
                <thead>
                    <tr>
                        <th>Registration id</th>
                        <th>Event Name</th>
                        <th>Event Date</th>
                        <th>Event Fees</th>
                        <th>Enrollment</th>
                        <th>First Name</th>
                        <th>Last name</th>
                        <!-- <th>Department</th>
                <th>Course</th> -->
                        <th>Transaction Id</th>
                        <th>Payment Id</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Payment Time</th>

                    </tr>
                </thead>
                </tbody>
                <?php
                $sql = "SELECT event_registration.id ,event.event_name,event.event_date,event.event_fees,";
                $sql = $sql . "event_registration.enrollment,user.first_name,user.last_name,user.department,user.course,";
                $sql = $sql . "transaction.transaction_id,transaction.payment_id,transaction.status,transaction.date,transaction.paid_time ";
                $sql = $sql . "FROM event_registration INNER JOIN user ";
                $sql = $sql . "on event_registration.enrollment=user.enrollment ";
                $sql = $sql . "inner join event on event_registration.event_id=event.id ";
                $sql = $sql . "INNER JOIN transaction ON event_registration.transaction_id=transaction.transaction_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td>
                                <?php echo $row["id"] ?>
                            </td>
                            <td>
                                <?php echo $row["event_name"] ?>
                            </td>
                            <td>
                                <?php echo $row["event_date"] ?>
                            </td>
                            <td>
                                <?php echo $row["event_fees"] ?>
                            </td>
                            <td>
                                <?php echo $row["enrollment"] ?>
                            </td>
                            <td>
                                <?php echo $row["first_name"] ?>
                            </td>
                            <td>
                                <?php echo $row["last_name"] ?>
                            </td>
                            <!-- <td>
                        <? //php echo $row["department"] ?>
                    </td>
                    <td>
                        <? //php echo $row["course"] ?>
                    </td> -->
                            <td>
                                <?php echo $row["transaction_id"] ?>
                            </td>
                            <td>
                                <?php echo $row["payment_id"] ?>
                            </td>
                            <td>
                                <?php echo $row["status"] ?>
                            </td>
                            <td>
                                <?php echo $row["date"] ?>
                            </td>
                            <td>
                                <?php echo $row["paid_time"] ?>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    echo "0 result";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                pagingType: 'full_numbers',
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, 'All'],
                ],
            });
        });
    </script>
    <a href="<?php echo $file_home ?>"><button class="btn"><i class="fa fa-home"></i> Previous</button></a><br>
</body>

</html>