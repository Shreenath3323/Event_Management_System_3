<?php
	session_start();
	include "../conn.php";
    include "../controller.php";

    $event_id=$_REQUEST['event_id'];
	$sql="SELECT * from event where id=$event_id";
	$result=$conn->query($sql);
				
    if($result->num_rows>0)
    {
        while($row=$result->fetch_assoc())
        {            
            $_SESSION['event_id']= $row["id"];
            $_SESSION['event_name']= $row["event_name"];
            $_SESSION['event_description']= $row["event_description"];
            $_SESSION['event_date']= $row["event_date"];
            $_SESSION['event_photo_link']= $row["event_photo_link"];
            $_SESSION['event_fees']= $row["event_fees"];
            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
                $url = "https://";   
            else  
                $url = "http://";   
            // Append the host(domain name, ip) to the URL.   
            $url.= $_SERVER['HTTP_HOST'];   
            
            // Append the requested resource location to the URL   
            $url.= $_SERVER['REQUEST_URI'];    
            
            //echo $url;
            $redirec_url = strstr($url, 'event_management', true) . 'event_management';
            $redirec_url=$redirec_url."/registration/$file_EventRegistration";

            header("Location:$redirec_url");
            exit();
        }
    }		
?>