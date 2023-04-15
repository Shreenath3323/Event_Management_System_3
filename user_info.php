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
    </head>

    <body> 
        <h1>List of all users</h1>
        <a href="<?php echo $file_home ?>"><button>Back</button></a><br><br>
        <table border="1">
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

        <?php
        $sql="SELECT * FROM user";
        $result=$conn->query($sql);
        
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                ?>
                <tr>
                    <td><?php echo $row["enrollment"] ?></td>
                    <td><?php echo $row["first_name"] ?></td>
                    <td><?php echo $row["last_name"] ?></td>
                    <td><?php echo $row["gender"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["mobile"] ?></td>
                    <td><?php echo $row["department"] ?></td>
                    <td><?php echo $row["course"] ?></td>
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
