<?php
session_start();
include "../controller.php";

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];

//echo $url;
$global_url = strstr($url, 'event_management', true) . 'event_management';
?>

<!-- <!DOCTYPE html> -->
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Registration Page</title>
    <link rel="stylesheet" href="../css/registrationPage.css" />
    <script>
        function checkEnrollment(enroll) {
            enrollment = enroll.value;
            var regex = /[^a-zA-Z0-9]/;
            testcase = regex.test(enrollment);
            if (!(testcase)) {
                request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText) {
                            //alert(this.responseText=="{}")
                            if (this.responseText != "{}") {
                                jsonresp = JSON.parse(this.responseText);
                                document.f1.fname.value = jsonresp.fname;
                                document.f1.lname.value = jsonresp.lname;
                                document.f1.email.value = jsonresp.email;
                                document.f1.mobile.value = jsonresp.mobile;
                                gender = jsonresp.gender;
                                if (jsonresp.gender == 'Male') {
                                    document.getElementById("male").checked = true;
                                }
                                else {
                                    document.getElementById("female").checked = true
                                }
                            }
                        }
                    }
                }
                request.open("GET", "<?php echo $global_url; ?>/api/<?php echo $file_GetUserDetails ?>?enroll=" + enrollment, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send();
            }
            else {
                alert("Enrollment can not contain special symbol")
                enroll.value = "";
                enroll.focus();
            }
        }
        function valcheckValesN() {
            enroll_id = document.f1.enroll_no.value;
            if (enroll_id) {
                fname = document.f1.fname.value;
                if (fname) {
                    lname = document.f1.lname.value;
                    if (lname) {
                        email = document.f1.email.value;
                        if (email) {
                            mobile = document.f1.mobile.value;
                            if (mobile) {
                                return true;
                            }
                            else {
                                alert("mobile number cannot be empty")
                                document.f1.mobile.focus();
                                return false;
                            }
                        }
                        else {
                            alert("Email cannot be empty")
                            document.f1.email.focus();
                            return false;
                        }
                    }
                    else {
                        alert("last name cannot be empty")
                        document.f1.lname.focus();
                        return false;
                    }
                }
                else {
                    alert("First Name cannot be empty");
                    document.f1.fname.focus();
                    return false;
                }
            }
            else {
                alert("enrollment number cannot be empty");
                document.f1.enroll_no.focus();
                return false;
            }
        }
        function checkRegistration() {
            chi = valcheckValesN();
            if (chi) {
                event_id = document.f1.event_id.value;
                enroll_id = document.f1.enroll_no.value;
                fname = document.f1.fname.value;
                lname = document.f1.lname.value;
                gender = document.f1.gender.value;
                email = document.f1.email.value;
                mobile = document.f1.mobile.value;
                departmentindex = document.f1.department.options.selectedIndex;
                department = document.f1.department.options[departmentindex].value;
                courseIndex = document.f1.course.options.selectedIndex;
                course = document.f1.course.options[courseIndex].value;
                date = new Date();
                currentdate = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
                curtime = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
                request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        CheckEventHistroy(event_id, enroll_id, fname, lname, email, mobile, currentdate, curtime)
                    }
                }
                request.open("POST", "<?php echo $global_url ?>/api/<?php echo $file_VerifyUser ?>", true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                data = "enroll=" + enroll_id + "&fname=" + fname + "&lname=" + lname + "&gender=" + gender + "&email=" + email + "&mob=" + mobile + "&dept=" + department + "&course=" + course;
                request.send(data);
            }
        }
        function createPayments(event_id, enroll_id, fname, lname, email, mobile, currentdate, curtime) {
            console.log(currentdate + " " + curtime)
            amt = document.f1.event_fees.value;
            request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    responseJson = JSON.parse(this.responseText);

                    console.log(responseJson);
                    if (responseJson.status == "created") {
                        var options = {
                            "key": "rzp_test_qp4uEp2A5RYhgI", // Enter the Key ID generated from the Dashboard
                            "amount": responseJson.amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                            "currency": "INR",
                            "name": "Payment form",
                            "description": "Test Transaction",
                            //"image": "https://asset.cloudinary.com/dzymiayhf/dc29e52e8a81b741c26ee9c4feb2cc25",
                            "order_id": responseJson.id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                            "handler": function (response) {
                                console.log(response.razorpay_payment_id);
                                console.log(response.razorpay_order_id);
                                console.log(response.razorpay_signature);
                                date = new Date();
                                curtime = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
                                updatePayment(response.razorpay_order_id, response.razorpay_payment_id, "paid", curtime);
                                document.f1.enroll_no.value = "";
                                document.f1.fname.value = "";
                                document.f1.lname.value = "";
                                document.f1.email.value = "";
                                document.f1.mobile.value = "";
                            },
                            "prefill": {
                                "name": fname + " " + lname,
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
                        rzp1.on('payment.failed', function (response) {
                            console.log(response.error.code);
                            console.log(response.error.description);
                            console.log(response.error.source);
                            console.log(response.error.step);
                            console.log(response.error.reason);
                            console.log(response.error.metadata.order_id);
                            console.log(response.error.metadata.payment_id);
                            console.log("error");
                            alert("payment Failed")
                        });
                        rzp1.open();
                    }
                }
            }
            request.open("POST", "<?php echo $global_url ?>/api/<?php echo $file_CreatePayment ?>", true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            data = "enroll=" + enroll_id + "&event_id=" + event_id + "&amt=" + amt + "&date=" + currentdate + "&curtime=" + curtime;
            request.send(data);
        }
        function updatePayment(order, payment, status, paidTime) {
            try {
                request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                        location.href = "../";
                    }
                }
                request.open("POST", "<?php echo $global_url ?>/api/<?php echo $file_UpdatePayment ?>", true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                data = "order=" + order + "&payment=" + payment + "&status=" + status + "&paidtime=" + paidTime;
                request.send(data);
            }
            catch (err) {
                alert(err);
                alert("payment successfull", "but we did not capture on server contact us")
            }
        }
        function CheckEventHistroy(event_id, enroll_id, fname, lname, email, mobile, currentdate, curtime) {
            try {
                request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        val = this.responseText;
                        //alert(val);
                        if (this.responseText[0] == "t") {
                            alert("already registered in the event");
                            document.f1.enroll_no.value = "";
                            document.f1.fname.value = "";
                            document.f1.lname.value = "";
                            document.f1.email.value = "";
                            document.f1.mobile.value = "";
                        }
                        else {
                            alert("During the process of payment do not press back button till payment it successfull and redirect to our website")
                            createPayments(event_id, enroll_id, fname, lname, email, mobile, currentdate, curtime);
                        }
                    }
                }
                request.open("GET", "<?php echo $global_url ?>/api/<?php echo $file_CheckRegistration ?>?event=" + event_id + "&enroll=" + enroll_id, true);
                request.send();
            }
            catch (err) {
                alert(err + "");
            }
        }
        function checkName(name) {
            nam = name.value;
            regex = /[^a-zA-Z]/g;
            namecase = (regex.test(nam));
            if (namecase) {
                alert("values cannot contain numbers or special symbol");
                name.value = "";
                name.focus();
            }
        }
        function checkMobile(phone) {
            mob_val = phone.value;
            if (mob_val.length != 10) {
                alert("mobile number should have 10 digits")
                phone.value = null;
                phone.focus();
            }
        }
        //oncontextmenu="return false"
    </script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="signupFrm">
        <form name="f1" method="post" enctype="multipart/form-data" class="form">
            <h1 class="title">Event Registration</h1><br>
            <div class="row">
                <div class="col-sm-4">
                    <input type="hidden" name="event_id" value="<?php echo $_SESSION['event_id']; ?>" />
                    <label class="label1">Event Name</label>
                    <div class="inputContainer">
                        <input type="text" name="event_name" value="<?php echo $_SESSION['event_name']; ?>"
                            class="input-dis" disabled />
                    </div>

                    <label class="label1">Event Date</label>
                    <div class="inputContainer">
                        <input type="date" name="event_date" value="<?php echo $_SESSION['event_date']; ?>"
                            class="input-dis" disabled />
                    </div>

                    <label class="label1">Enrollment Number</label>
                    <div class="inputContainer">
                        <input type="text" name="enroll_no" onchange="checkEnrollment(this)" class="input" required />
                    </div>

                    <label class="label1">Last Name</label>
                    <div class="inputContainer">
                        <input type="text" name="lname" onchange="checkName(this)" class="input" required />
                    </div>
                    <label class="label1">Email</label>
                    <div class="inputContainer">
                        <input type="email" name="email" class="input" required />
                    </div>
                    <label class="label1">Department</label>
                    <div class="inputContainer">
                        <select name="department" class="input">
                            <option value="CSE">CSE</option>
                            <option value="IT">IT</option>
                        </select>
                    </div>
                    <div class="inputContainer">
                        <input type="button" value="Pay Fees" onclick="checkRegistration()" class="button" />
                    </div>
                </div>
                <div class="col-sm-4">
                    <label class="label1">Event Description</label>
                    <div class="inputContainer">
                        <textarea name="event_description" rows="3" cols="30" class="input-dis"
                            disabled><?php echo $_SESSION['event_description']; ?></textarea>
                    </div>
                    <label class="label1">Event Fees</label>
                    <div class="inputContainer">
                        <input type="number" name="event_fees" value="<?php echo $_SESSION['event_fees']; ?>"
                            class="input-dis" disabled />
                    </div>
                    <label class="label1">First Name</label>
                    <div class="inputContainer">
                        <input type="text" name="fname" onchange="checkName(this)" class="input" required /></td>
                    </div>
                    <label class="label1">Gender</label>
                    <div class="inputContainer">
                        <div class="switch-field">
                            <input type="radio" name="gender" value="Male" id="male" checked /><label
                                for="male">Male</label>
                            <input type="radio" name="gender" value="Female" id="female" /><label
                                for="female">Female</label>
                        </div>
                    </div>
                    <label class="label1">Mobile Number</label>
                    <div class="inputContainer">
                        <input type="number" name="mobile" onchange="checkMobile(this)" class="input" required />
                    </div>
                    <label class="label1">Course</label>
                    <div class="inputContainer">
                        <select name="course" class="input">
                            <option value="Diploma">Diploma</option>
                            <option value="BTect">BTect</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="<?php echo $_SESSION['event_photo_link']; ?>" class="photo" alt="alt" />
                            </div>
                            <div class="flip-card-back">
                                <div class="inputContainer">
                                    <p>Event Name:
                                        <?php echo $_SESSION['event_name']; ?>
                                    </p>
                                    <p>Fees:
                                        <?php echo $_SESSION['event_fees']; ?>
                                    </p>
                                    <p>Description:
                                        <?php echo $_SESSION['event_description']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>