<?php include("view/header.php"); ?>

<div id="travel_details" class="main_content_area">
    <ul id="options_menu">
        <li><a href="create_activity.php">Create a new activity</a></li> <!-- Redirects to create activity page -->
    </ul>
    
    <h4>Current Schedule</h4>
    <table id="current_schedule" class="with_border left_indent"> <!-- This table show the current activities scheduled for this trip on a day-by-day basis. If there are no activities, the page should say "There are currently no activities planned for this trip"-->
        <tr>
            <th>Day</th> <!-- Day 1, Day 2, etc...-->
            <th>Date</th>
            <th>Activity</th> 
            <th>Duration</th>
        </tr>
            <td>1</td>
            <td>February 14, 2014</td> <!-- Depends on the dates chosen when this travel plan was created -->
            <td>Visit Trina</td>
            <td>2 hours</td>
            <td><input type="button" value="view/edit"></td> <!-- Clicking on this button shows the details of the activity and allows the user to change its details-->
        </tr>
    </table>
    
    <h4>Activities to Consider</h4>
    <table id="suggestions" class="with_border left_indent"> <!-- This table shows activities that have been suggested by the user or users' friends. The user can then drag and drop these activities into his/her current schedule for this trip -->
        <tr>
            <th>Activity Name</th>
            <th>Type</th> <!-- Food, Accomodation, Sites, etc -->
            <th>Duration</th> <!-- In hours or days -->
            <th>Author</th> <!-- Shows who provided this suggestion -->
        </tr>
        <tr>
            <td>Eat at Kumos!</td>
            <td>Dining</td>
            <td>1 Hour</td>
            <td>Daniel</td>
            <td><input type="button" value="view details" onClick="parent.location='edit_activity.php'"></td>
            <td><input type="button" value="remove"></td> <!-- Sometimes friends can give really rubbish suggestions, so we will need this button to remove any unwanted entries -->
        </tr>
    </table>
</div>
<?php include("view/footer.php"); ?>