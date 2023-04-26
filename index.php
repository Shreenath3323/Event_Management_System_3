<?php
// include "$file_login";
include "controller.php";
?>
<html>

<head>
    <link rel="stylesheet" href="css/button.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script arc="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        function getAllData() {
            table = document.getElementById("tableInfo");
            tableHead = document.createElement("thead");
            tableheader = ["Registration id", "Event Name", "Event Date", "Event Fees", "Enrollment", "First Name", "Last name", "Department", "Course", "Status", "Payment Date", "Payment Time"];
            tablerow_1 = document.createElement("tr");
            for (i = 0; i < tableheader.length; i++) {
                tabledata = document.createElement("th");
                value = document.createTextNode(tableheader[i]);
                tabledata.appendChild(value);
                tablerow_1.appendChild(tabledata);
            }

            tableHead.appendChild(tablerow_1);

            tableBody = document.createElement("tbody");

            event_name_arr = [];
            request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    jsonresp = JSON.parse(this.responseText);

                    for (i = jsonresp.length - 1; i >= 0; i--) {
                        event_name_arr.push(jsonresp[i]["event_name"]);
                        tablerow = document.createElement("tr");
                        for (j in jsonresp[i]) {
                            tabledata = document.createElement("td");
                            value = document.createTextNode(jsonresp[i][j]);
                            tabledata.appendChild(value);
                            tablerow.appendChild(tabledata);
                        }

                        tableBody.appendChild(tablerow);

                    }
                    table.appendChild(tableHead);
                    table.appendChild(tableBody);
                    $(document).ready(function () {
                        $('#tableInfo').DataTable({
                            pagingType: 'full_numbers',
                            lengthMenu: [
                                [5, 10, 25, 50, -1],
                                [5, 10, 25, 50, 'All'],
                            ],
                        });
                    });


                    createDropDown(event_name_arr);
                }
            };
            request.open("GET", "/event_management/api/<?php echo $file_GetUserRegistrationDetail ?>", true);
            request.send();
        }
        function createDropDown(registerValues) {
            event_set = new Set(registerValues);
            registerValues = Array.from(event_set)
            for (i = 0; i < registerValues.length; i++) {
                option_event_name = new Option(registerValues[i], registerValues[i]);
                document.f1.event_names.options[document.f1.event_names.options.length] = option_event_name;
            }
        }
        function searchByFName(val) {
            document.f1.lname_val.value = null;
            document.f1.enrollment_val.value = null;
            table = document.getElementById("tableInfo");
            fname = val.value;
            if (fname) {
                request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        for (var i = 1; i < table.rows.length;) {
                            table.deleteRow(i);
                        }
                        console.log(this.responseText)
                        jsonresp = JSON.parse(this.responseText);

                        for (i = 0; i < jsonresp.length; i++) {
                            tablerow = document.createElement("tr");
                            for (j in jsonresp[i]) {
                                tabledata = document.createElement("td");
                                value = document.createTextNode(jsonresp[i][j]);
                                tabledata.appendChild(value);
                                tablerow.appendChild(tabledata);
                            }
                            table.appendChild(tablerow);
                        }
                    }
                };
                request.open("post", "/event_management/api/<?php echo $file_SearchByFirstName ?>", true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send("fname=" + fname);
            }
            else {
                location.reload();
            }
        }
        function searchByLName(val) {
            document.f1.fname_val.value = null;
            document.f1.enrollment_val.value = null;
            table = document.getElementById("tableInfo");
            lname = val.value;
            if (lname) {
                request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        for (var i = 1; i < table.rows.length;) {
                            table.deleteRow(i);
                        }
                        console.log(this.responseText)
                        jsonresp = JSON.parse(this.responseText);

                        for (i = 0; i < jsonresp.length; i++) {
                            tablerow = document.createElement("tr");
                            for (j in jsonresp[i]) {
                                tabledata = document.createElement("td");
                                value = document.createTextNode(jsonresp[i][j]);
                                tabledata.appendChild(value);
                                tablerow.appendChild(tabledata);
                            }
                            table.appendChild(tablerow);
                        }
                    }
                };
                request.open("post", "/event_management/api/<?php echo $file_SearchByLastName ?>", true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send("lname=" + lname);
            }
            else {
                location.reload();
            }
        }
        function searchByEnroll(val) {
            document.f1.lname_val.value = null;
            document.f1.fname_val.value = null;
            table = document.getElementById("tableInfo");
            enroll = val.value;
            if (enroll) {
                request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        for (var i = 1; i < table.rows.length;) {
                            table.deleteRow(i);
                        }
                        console.log(this.responseText)
                        jsonresp = JSON.parse(this.responseText);

                        for (i = 0; i < jsonresp.length; i++) {
                            tablerow = document.createElement("tr");
                            for (j in jsonresp[i]) {
                                tabledata = document.createElement("td");
                                value = document.createTextNode(jsonresp[i][j]);
                                tabledata.appendChild(value);
                                tablerow.appendChild(tabledata);
                            }
                            table.appendChild(tablerow);
                        }
                    }
                };
                request.open("post", "/event_management/api/<?php echo $file_SearchByEnrollment ?>", true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send("enroll=" + enroll);
            }
            else {
                location.reload();
            }
        }
        function getByEvent(val) {
            event_name = val.value;
            if (event_name) {
                request = new XMLHttpRequest();
                request.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        for (var i = 1; i < table.rows.length;) {
                            table.deleteRow(i);
                        }
                        console.log(this.responseText)
                        jsonresp = JSON.parse(this.responseText);
                        tableBody = document.createElement("tbody");
                        for (i = 0; i < jsonresp.length; i++) {
                            tablerow = document.createElement("tr");
                            for (j in jsonresp[i]) {
                                tabledata = document.createElement("td");
                                value = document.createTextNode(jsonresp[i][j]);
                                tabledata.appendChild(value);
                                tablerow.appendChild(tabledata);
                            }
                            tableBody.appendChild(tablerow);
                        }
                        table.appendChild(tableBody);
                    }
                };
                request.open("post", "/event_management/api/<?php echo $file_SearchByEventName ?>", true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send("event_name=" + event_name);
            }
            else {
                location.reload();
            }
        }
    </script>
    <link rel="stylesheet" href="css/indexFile.css">
</head>

<body onload="getAllData()" class="bg-image">
    <form name="f1">
        <h1 class="text">Registered Participants</h1>
        <div class="card">
            <div class="container">
                Event Name:
                <div class="inputContainer">
                    <select name="event_names" class="input" onclick="getByEvent(this)"></select>
                </div>
                <input type="button" class="btn" onclick="location.reload()" value="Reset" />
                <table id="tableInfo" class="display cell-border tablefont">
                </table>
            </div>
        </div>
    </form>
</body>

</html>