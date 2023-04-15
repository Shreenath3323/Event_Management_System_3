<?php
    include "conn.php";
    include "controller.php";
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("Location:login.php");
        exit();
    }
    

    // 3. Get the Current Page Number

    if (isset($_GET['page_no']) && $_GET['page_no']!="") 
    {
        $page_no = $_GET['page_no'];
    } 
    else
    {
        $page_no = 1;
    }
    // echo $page_no;

    // 4. SET Total Records Per Page Value
    $total_records_per_page = 5;

    // 5. Calculate OFFSET Value and SET other Variables
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";

    // 6. Get the Total Number of Pages for Pagination
    $result_count = mysqli_query($conn,"SELECT COUNT(*) As total_records FROM `user`");
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1

    // 7. SQL Query for Fetching Limited Records using LIMIT Clause and OFFSET
    ?>
     <!-- 8. Showing Current Page Number Out of Total  -->
    
    <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong><br><br>

    <html>
        <head>
        </head>

        <body> 
            <a href="<?php echo $file_home ?>"><button>Back</button></a><br>
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
                $result = mysqli_query($conn,"SELECT * FROM `user` LIMIT $offset, $total_records_per_page");
                while($row = mysqli_fetch_array($result))
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
            ?>
            </table>
        </body>
    </html>

    

    <!-- 9. Creating Pagination Buttons -->

    <ul class="pagination">
    <?php if($page_no > 1)
    {
        echo "<a href='?page_no=1'><button>First Page</button></a>";
    } 
    ?>

    <?php if($page_no <= 1)
    { 
        echo ""; 
    } ?>
    <a <?php if($page_no > 1)
    {
        echo "href='?page_no=$previous_page'";
    } ?>><button>Previous</button></a>
    
    <?php if($page_no >= $total_no_of_pages)
        {
            echo "";
        } 
    ?>
    <?php
    if ($total_no_of_pages <= 10)
    {  	 
        for ($counter = 1; $counter <= $total_no_of_pages; $counter++)
        {
            if ($counter == $page_no) 
            {
                echo "<class='active'><a><button>$counter</button></a>";	
            }
            else
            {
                echo "<a href='?page_no=$counter'><button>$counter</button></a>";
            }
        }
    }
    elseif ($total_no_of_pages > 10)
    {
        if($page_no <= 4) 
        {			
            for ($counter = 1; $counter < 8; $counter++)
            {		 
                if ($counter == $page_no) 
                {
                    echo "<class='active'><a><button>$counter</button></a>";	
                }
                else
                {
                    echo "<a href='?page_no=$counter'><button>$counter</button></a>";
                }
            }
            echo "<a>...</a>";
            echo "<a href='?page_no=$second_last'><button>$second_last</button></a>";
            echo "<a href='?page_no=$total_no_of_pages'><button>$total_no_of_pages</button></a>";
        }
        elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) 
        {		 
            echo "<a href='?page_no=1'><button>1</button></a>";
            echo "<a href='?page_no=2'><button>2</button></a>";
            echo "<a>...</a>";
            for (
                $counter = $page_no - $adjacents;
                $counter <= $page_no + $adjacents;
                $counter++
                ) {		
                if ($counter == $page_no) 
                {
                    echo "<class='active'><a><button>$counter</button></a>";	
                }
                else
                {
                    echo "<a href='?page_no=$counter'><button>$counter</button></a>";
                }                  
                }
            echo "<a>...</a>";
            echo "<a href='?page_no=$second_last'><button>$second_last</button></a>";
            echo "<a href='?page_no=$total_no_of_pages'><button>$total_no_of_pages</button></a>";
        }
        else 
        {
            echo "<a href='?page_no=1'><button>1</button></a>";
            echo "<a href='?page_no=2'><button>2</button></a>";
            echo "<a>...</a>";
            for (
                    $counter = $total_no_of_pages - 6;
                    $counter <= $total_no_of_pages;
                    $counter++
                    ) {
                    if ($counter == $page_no) 
                    {
                        echo "<class='active'><a><button>$counter</button></a>";	
                    }
                    else
                    {
                        echo "<a href='?page_no=$counter'><button>$counter</button></a>";
                    }                   
                    }
            }
        }
    ?>
        <a <?php if($page_no < $total_no_of_pages) 
        {
            echo "href='?page_no=$next_page'";
        } ?>><button>Next</button></a>
    

    <?php if($page_no < $total_no_of_pages){
    echo "<a href='?page_no=$total_no_of_pages'><button>Last</button></a>";
    } ?>
    </ul>

    