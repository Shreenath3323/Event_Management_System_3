<?php
	//include "login.php";
	
?>
<html>
    <head>
        <script>
            function getAllData()
            {
                table=document.getElementById("tableInfo");
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
                            
                            table.appendChild(tablerow);
                        }     
                        createDropDown(event_name_arr);                         
                    }
                };                           
                request.open("GET","/event_management/api/GetUserRegistrationDetail.php",true);
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
                    request.open("post","/event_management/api/SearchByFirstName.php",true);
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
                    request.open("post","/event_management/api/SearchByLastName.php",true);
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
                    request.open("post","/event_management/api/SearchByEnrollment.php",true);
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
                    request.open("post","/event_management/api/SearchByEventName.php",true);
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
		<a href="login.php">Login</a>
		<h1>Registrations</h1>
        <input type="text" name="fname_val" placeholder="Search by first name" onchange="searchByFName(this)"/>
        <input type="text" name="lname_val" placeholder="Search by last name" onchange="searchByLName(this)"/>
        <input type="text" name="enrollment_val" placeholder="Search by Enrollment Number" onchange="searchByEnroll(this)"/>
		Event Name: <select name="event_names" onclick="getByEvent(this)"></select>
        <input type="button" onclick="location.reload()" value="Reset" />
        <table border="1" id="tableInfo">
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
        </form>
	</body>
</html>