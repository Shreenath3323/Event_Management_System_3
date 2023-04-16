<?php
	// include "$file_login";
	include "controller.php";
?>
<html>
    <head>
        <!-- <link rel="stylesheet" href="css/index_file.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script arc="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
        <script>
            function getAllData()
            {
                table=document.getElementById("tableInfo");
                tableBody=document.createElement("tbody");

                event_name_arr=[];
                request=new XMLHttpRequest();
                request.onreadystatechange=function()
                {
                    if (this.readyState == 4 && this.status == 200) 
                    {   
                        jsonresp=JSON.parse(this.responseText);

                        for(i=jsonresp.length-1;i>=0;i--)
                        { 
                            event_name_arr.push(jsonresp[i]["event_name"]);
                            tablerow=document.createElement("tr");
                            for(j in jsonresp[i])
                            {
                                tabledata=document.createElement("td");
                                value=document.createTextNode(jsonresp[i][j]);
                                tabledata.appendChild(value);
                                tablerow.appendChild(tabledata);
                            }
                            
                            tableBody.appendChild(tablerow);
                            
                        }  
                            table.appendChild(tableBody);
                            $(document).ready(function () {
            $('#tableInfo').DataTable({
                pagingType: 'full_numbers',
                lengthMenu: [
            [5,10, 25, 50, -1],
            [5,10, 25, 50, 'All'],
        ],
            });
        });
                            
                           
                        createDropDown(event_name_arr);                         
                    }
                };                           
                request.open("GET","/event_management/api/<?php echo $file_GetUserRegistrationDetail ?>",true);
                request.send();
            }
            function createDropDown(registerValues)
            {
                event_set=new Set(registerValues);
                registerValues=Array.from(event_set)
                for(i=0;i<registerValues.length;i++)
                {
                    option_event_name=new Option(registerValues[i],registerValues[i]);
                    document.f1.event_names.options[document.f1.event_names.options.length]=option_event_name;
                }
            }
            function searchByFName(val)
            {
                document.f1.lname_val.value=null;
                document.f1.enrollment_val.value=null;
                table=document.getElementById("tableInfo");
                fname=val.value;
                if(fname)
                {
                    request=new XMLHttpRequest();
                    request.onreadystatechange=function()
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {   
                            for(var i = 1;i<table.rows.length;){
                                table.deleteRow(i);
                            }
                            console.log(this.responseText)
                            jsonresp=JSON.parse(this.responseText);

                            for(i=0;i<jsonresp.length;i++)
                            { 
                                tablerow=document.createElement("tr");
                                for(j in jsonresp[i])
                                {
                                    tabledata=document.createElement("td");
                                    value=document.createTextNode(jsonresp[i][j]);
                                    tabledata.appendChild(value);
                                    tablerow.appendChild(tabledata);
                                }
                                table.appendChild(tablerow);
                            }                        
                        }
                    };                           
                    request.open("post","/event_management/api/<?php echo $file_SearchByFirstName ?>",true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send("fname="+fname);
                }
                else
                {
                    location.reload();
                }
            }
            function searchByLName(val)
            {
                document.f1.fname_val.value=null;
                document.f1.enrollment_val.value=null;
                table=document.getElementById("tableInfo");
                lname=val.value;
                if(lname)
                {
                    request=new XMLHttpRequest();
                    request.onreadystatechange=function()
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {   
                            for(var i = 1;i<table.rows.length;){
                                table.deleteRow(i);
                            }
                            console.log(this.responseText)
                            jsonresp=JSON.parse(this.responseText);

                            for(i=0;i<jsonresp.length;i++)
                            { 
                                tablerow=document.createElement("tr");
                                for(j in jsonresp[i])
                                {
                                    tabledata=document.createElement("td");
                                    value=document.createTextNode(jsonresp[i][j]);
                                    tabledata.appendChild(value);
                                    tablerow.appendChild(tabledata);
                                }
                                table.appendChild(tablerow);
                            }                        
                        }
                    };                           
                    request.open("post","/event_management/api/<?php echo $file_SearchByLastName ?>",true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send("lname="+lname);
                }
                else
                {
                    location.reload();
                }
            }
            function searchByEnroll(val)
            {
                document.f1.lname_val.value=null;
                document.f1.fname_val.value=null;
                table=document.getElementById("tableInfo");
                enroll=val.value;
                if(enroll)
                {
                    request=new XMLHttpRequest();
                    request.onreadystatechange=function()
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {   
                            for(var i = 1;i<table.rows.length;){
                                table.deleteRow(i);
                            }
                            console.log(this.responseText)
                            jsonresp=JSON.parse(this.responseText);

                            for(i=0;i<jsonresp.length;i++)
                            { 
                                tablerow=document.createElement("tr");
                                for(j in jsonresp[i])
                                {
                                    tabledata=document.createElement("td");
                                    value=document.createTextNode(jsonresp[i][j]);
                                    tabledata.appendChild(value);
                                    tablerow.appendChild(tabledata);
                                }
                                table.appendChild(tablerow);
                            }                        
                        }
                    };                           
                    request.open("post","/event_management/api/<?php echo $file_SearchByEnrollment ?>",true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send("enroll="+enroll);
                }
                else
                {
                    location.reload();
                }
            }
            function getByEvent(val)
            {
                event_name=val.value;
                if(event_name)
                {
                    request=new XMLHttpRequest();
                    request.onreadystatechange=function()
                    {
                        if (this.readyState == 4 && this.status == 200) 
                        {   
                            for(var i = 1;i<table.rows.length;){
                                table.deleteRow(i);
                            }
                            console.log(this.responseText)
                            jsonresp=JSON.parse(this.responseText);

                            for(i=0;i<jsonresp.length;i++)
                            { 
                                tablerow=document.createElement("tr");
                                for(j in jsonresp[i])
                                {
                                    tabledata=document.createElement("td");
                                    value=document.createTextNode(jsonresp[i][j]);
                                    tabledata.appendChild(value);
                                    tablerow.appendChild(tabledata);
                                }
                                table.appendChild(tablerow);
                            }                        
                        }
                    };                           
                    request.open("post","/event_management/api/<?php echo $file_SearchByEventName ?>",true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send("event_name="+event_name);
                }
                else
                {
                    location.reload();
                }
            }
        </script>
    </head>
	<body onload="getAllData()">
    <form name="f1">
		<a href="<?php echo $file_login; ?>">Login</a>
		<h1>Registrations</h1>
        <input type="text" name="fname_val" placeholder="Search by first name" onchange="searchByFName(this)"/>
        <input type="text" name="lname_val" placeholder="Search by last name" onchange="searchByLName(this)"/>
        <input type="text" name="enrollment_val" placeholder="Search by Enrollment Number" onchange="searchByEnroll(this)"/>
		Event Name: <select name="event_names" onclick="getByEvent(this)"></select>
        <input type="button" onclick="location.reload()" value="Reset" />
        <table id="tableInfo" class="display cell-border tablefont">
        <thead>
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
    </thead>
        </table>
        <script>
        // $(document).ready(function () {
        //     $('#tableInfo').DataTable({
        //         pagingType: 'full_numbers',
        //         lengthMenu: [
        //     [5,10, 25, 50, -1],
        //     [5,10, 25, 50, 'All'],
        // ],
        //     });
        // });
    </script>
        </form>
	</body>
</html>