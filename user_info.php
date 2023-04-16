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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/registration.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script arc="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
</head>

<body class="bg-image">
    <center>
        <h1 class="text">Registration</h1>
    </center>
    <div class="card">
        <div class="container">
            <table id="example" class="display cell-border tablefont " style="width:100%;">
                <thead>
                    <tr>
                        <th>Enrollment</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Department</th>
                        <th>Course</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM `user`");
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row["enrollment"] ?>
                            </td>
                            <td>
                                <?php echo $row["first_name"] ?>
                            </td>
                            <td>
                                <?php echo $row["last_name"] ?>
                            </td>
                            <td>
                                <?php echo $row["gender"] ?>
                            </td>
                            <td>
                                <?php echo $row["email"] ?>
                            </td>
                            <td>
                                <?php echo $row["mobile"] ?>
                            </td>
                            <td>
                                <?php echo $row["department"] ?>
                            </td>
                            <td>
                                <?php echo $row["course"] ?>
                            </td>
                        </tr>

                        <?php
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