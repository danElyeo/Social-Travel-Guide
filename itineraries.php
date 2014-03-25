<?php include("header.php"); ?>


<!-- Show a list of existing travel itineraries -->
<!-- This list will be populated by the database. If there is no current plan, the page will state "You currently have no travel plans. Click here to create one!" -->
<div class="main_content_area">
	<ul id="nav_menu"> 
		<li><a href="create_travel_plan.php">Create a new travel plan</a></li>
	</ul>
    <h4>Current Itineraries</h4>
    <table border="1px solid black" class="center">
        <tr>
            <th>Date</th>
            <th>Destination</th>
            <th>Duration</th>
        </tr>
        <tr> <!-- Sample data -->
            <td>February 14, 2014</td>
            <td>New Haven, Connecticut</td>
            <td>3 days</td>
            <td><input type="button" value="view" onClick="parent.location='travel_details.php'"></td> <!-- Clicking on the view button shows the details of this trip-->
            <td><input type="button" value="delete"></td> <!-- Clicking on the delete button shows deletes the entire schedule altogether. Alert the user if they really want to do this.-->
        </tr>
    </table>
</div>

<?php include("footer.php"); ?>