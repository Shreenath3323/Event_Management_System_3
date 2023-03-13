<html>
    <head>
        <title>Event adding form</title>
    </head>
    <body>
        <form action="event_add1.php" method="POST">
            <h1 align="center">Add New Event</h1>

            <!-- <input type="number" name="id" required></td>-> -->
		    <input type="text" name="event_name" placeholder="Enter Event Name" required>
		    <input type="text" name="event_description" placeholder="Enter Event Description" required>
			<input type="date" name="event_date" placeholder="Enter Event Date" required>
			<input type="file" name="event_photo" placeholder="Enter Event Photo" accept="images/*" required>
			<input type="number" name="event_fees" placeholder="Enter Event Fees" required>
            			
            <button type="submit">
				Add
		    </button>
        </form>
    </body>
</html>