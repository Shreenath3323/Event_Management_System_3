<?php
    session_start();
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
        $url = "https://";   
    else  
        $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
    
    //echo $url;
    $global_url = strstr($url, 'event_management', true) . 'event_management';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <script>
            function checkEnrollment(enroll)
            {
                enrollment=enroll.value;
                request=new XMLHttpRequest();
                request.onreadystatechange=function()
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {                       
                        if(this.responseText)
                        {
                            jsonresp=JSON.parse(this.responseText);
                            console.log(jsonresp)
                            document.f1.fname.value=jsonresp.fname;
                            document.f1.lname.value=jsonresp.lname;
                            document.f1.email.value=jsonresp.email;
                            document.f1.mobile.value=jsonresp.mobile;
                            gender=jsonresp.gender;
                            if(jsonresp.gender=='Male')
                            {
                                document.getElementById("male").checked=true;
                            }
                            else
                            {
                                document.getElementById("female").checked=true
                            }
                        }
                    }
                }                                
                request.open("GET","<?php echo $global_url;?>/api/GetUserDetails.php?enroll="+enrollment,true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send();
            }
            function checkRegistration()
            {
                event_id=document.f1.event_id.value;
                enroll_id=document.f1.enroll_no.value;
                fname=document.f1.fname.value;
                lname=document.f1.lname.value;
                gender=document.f1.gender.value;
                email=document.f1.email.value;
                mobile=document.f1.mobile.value;
                departmentindex=document.f1.department.options.selectedIndex;
                department=document.f1.department.options[departmentindex].value;
                courseIndex=document.f1.course.options.selectedIndex;
                course=document.f1.course.options[courseIndex].value;
                date=new Date();
                currentdate=date.getDate()+"-"+(date.getMonth()+1)+"-"+date.getFullYear();
                curtime=date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
                //alert(event_id+" "+enroll_id+" "+fname+" "+lname+" "+gender+" "+email+" "+mobile+" "+course+" "+department);
                request=new XMLHttpRequest();
                request.onreadystatechange=function()
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        //alert(this.responseText);
                        CheckEventHistroy(event_id,enroll_id,fname,lname,email,mobile,currentdate,curtime)
                    }
                }                                
                request.open("POST","<?php echo $global_url?>/api/VerifyUser.php",true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                data="enroll="+enroll_id+"&fname="+fname+"&lname="+lname+"&gender="+gender+"&email="+email+"&mob="+mobile+"&dept="+department+"&course="+course;
                request.send(data);
            }
            function createPayments(event_id,enroll_id,fname,lname,email,mobile,currentdate,curtime)
            {
                console.log(currentdate+" "+curtime)
                amt=document.f1.event_fees.value;
                request=new XMLHttpRequest();
                request.onreadystatechange=function()
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {
                        responseJson=JSON.parse(this.responseText);
                        alert(responseJson);
                        alert(this.responseText);
                       
                        console.log(responseJson);
                        if(responseJson.status=="created")
                        {
                            var options = {
                            "key": "rzp_test_qp4uEp2A5RYhgI", // Enter the Key ID generated from the Dashboard
                            "amount": responseJson.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                            "currency": "INR",
                            "name": "Payment form",
                            "description": "Test Transaction",
                            "image": "https://asset.cloudinary.com/dzymiayhf/dc29e52e8a81b741c26ee9c4feb2cc25",
                            "order_id": responseJson.id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                            "handler": function (response){
                                console.log(response.razorpay_payment_id);
                                console.log(response.razorpay_order_id);
                                console.log(response.razorpay_signature);
                                date=new Date();
                                curtime=date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
                                updatePayment(response.razorpay_order_id,response.razorpay_payment_id,"paid",curtime);
                                document.f1.enroll_no.value="";
                                document.f1.fname.value="";
                                document.f1.lname.value="";
                                document.f1.email.value="";
                                document.f1.mobile.value="";
                            },
                            "prefill": {
                                "name": fname+" "+lname,
                                "email": email,
                                "contact": mobile
                            },
                            "notes": {
                                "address": "Razorpay Corporate Office"
                            },
                            "theme": {
                                "color": "#3399cc"
                            }
                            };
                            var rzp1 = new Razorpay(options);
                            rzp1.on('payment.failed', function (response){
                                    console.log(response.error.code);
                                    console.log(response.error.description);
                                    console.log(response.error.source);
                                    console.log(response.error.step);
                                    console.log(response.error.reason);
                                    console.log(response.error.metadata.order_id);
                                    console.log(response.error.metadata.payment_id);
                                    console.log("error")
                            });
                            rzp1.open();
                        }
                    }
                }                                
                request.open("POST","<?php echo $global_url?>/api/CreatePayment.php",true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                data="enroll="+enroll_id+"&event_id="+event_id+"&amt="+amt+"&date="+currentdate+"&curtime="+curtime;
                request.send(data);
            }
            function updatePayment(order,payment,status,paidTime)
            {
                try
                {
                    request=new XMLHttpRequest();
                    request.onreadystatechange=function()
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {
                            alert(this.responseText);
                        }
                    }                                
                    request.open("POST","<?php echo $global_url?>/api/UpdatePayment.php",true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    data="order="+order+"&payment="+payment+"&status="+status+"&paidtime="+paidTime;
                    request.send(data);
                }
                catch(err)
                {
                    alert(err);
                    alert("payment successfull","but we did not capture on server contact us")
                }
            }
            function CheckEventHistroy(event_id,enroll_id,fname,lname,email,mobile,currentdate,curtime)
            {
                try
                {
                    request=new XMLHttpRequest();
                    request.onreadystatechange=function()
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {
                            val=this.responseText;
                            //alert(val);
                            if(this.responseText[0]=="t")
                            {
                                alert("already registered in the event");
                                document.f1.enroll_no.value="";
                                document.f1.fname.value="";
                                document.f1.lname.value="";
                                document.f1.email.value="";
                                document.f1.mobile.value="";
                            }
                            else
                            {
                                alert("during the process of payment do not press back button till payment it successfull and redirect to our website")
                                createPayments(event_id,enroll_id,fname,lname,email,mobile,currentdate,curtime);
                            }
                        }
                    }                                
                    request.open("GET","<?php echo $global_url?>/api/CheckRegistration.php?event="+event_id+"&enroll="+enroll_id,true);
                    request.send();
                }
                catch(err)
                {
                    alert(err+"");
                }
            }
        </script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    </head>
    <body>
        <form name="f1" method="post" enctype="multipart/form-data">
            <h1>Event Registration</h1><br>
            <center><img src="<?php echo $_SESSION['event_photo_link'];?>" width="200" height="200" alt="alt"/></center>
            <fieldset>
            <legend>Person Info</legend>
            <input type="hidden" name="event_id" value="<?php echo $_SESSION['event_id'];?>"/>
            <table>
                <tr>
                    <td><label>Event Name</label></td>
                    <td colspan="2"><input type="text" name="event_name" value="<?php echo $_SESSION['event_name'];?>" disabled/></td>
                </tr>
                <tr>
                    <td><label>Event Description</label></td>
                    <td><textarea name="event_description" rows="3" cols="30" disabled><?php echo $_SESSION['event_description'];?></textarea></td>
                </tr>
                <tr>
                    <td><label>Event Date</label></td>
                    <td><input type="date" name="event_date" value="<?php echo $_SESSION['event_date'];?>" disabled/></td>
                </tr>
                <tr>
                    <td><label>Event Fees</label></td>
                    <td><input type="number" name="event_fees" value="<?php echo $_SESSION['event_fees'];?>" disabled/></td>
                </tr>
                <tr>
                    <td><label>Enrollment Number</label></td>
                    <td><input type="text" name="enroll_no" onchange="checkEnrollment(this)" required/></td>
                </tr>
                <tr>
                    <td><label>First Name</label></td>
                    <td colspan="2"><input type="text" name="fname"  required/></td>
                </tr>
                <tr>
                    <td><label>Last Name</label></td>
                    <td><input type="text" name="lname"  required/></td>
                </tr>
                <tr>
                    <td><label>Gender</label></td>
                    <td><input type="radio" name="gender" value="Male" id="male" checked/>Male
                        <input type="radio" name="gender" value="Female" id="female"/>Female</td>
                </tr>
                <tr>
                    <td><label>Email</label></td>
                    <td><input type="email" name="email" required/></td>
                </tr>
                <tr>
                    <td><label>Mobile Number</label></td>
                    <td><input type="number" name="mobile" required/></td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>
                        <select name="department">
                            <option value="CSE">CSE</option>
                            <option value="IT">IT</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Course</td>
                    <td>
                        <select name="course">
                            <option value="Diploma">Diploma</option>
                            <option value="BTect">BTect</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><center><input type="button" value="Pay Fees" onclick="checkRegistration()"/></center></td>
                </tr>
            </table>       
            </fieldset>
        </form>
    </body>
</html>