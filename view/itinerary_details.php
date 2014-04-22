<?php 
require_once('../util/main.php');
include("../view/header.php");

// If the itinerary id has been set, show the details, as well as its activities
if(!isset($_SESSION))
{
	session_start();	
}

if(isset($_POST['itinerary_id']))
{
	//echo("Current itinerary id: " . $_POST['itinerary_id']);
    // show the details of only the selected itinerary 
	//print_r($_SESSION['itineraries']);
	// Get the row index of the selected itinerary
	//for ($index = 0; $index < count($_SESSION['itineraries']); $index++)
	
	foreach($_SESSION['itineraries'] as $row)
	{
		if($row['itinerary_id'] == $_POST['itinerary_id']): ?>
			
            <div id='itinerary_details' class='main_content_area'>
            <h2 class='center'>Itinerary Details</h2>
			<table id="itinerary_table">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Destination</th>
                    <th>Start date</th>
                    <th>End date</th>
                </tr>
                <tr>
                    <td><?php echo $row['itinerary_name']; ?></td>
                    <td><?php echo $row['itinerary_desc']; ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['start_date']; ?></td>
                    <td><?php echo $row['end_date']; ?></td>
                </tr>
        	</table>
           
           	<br>
            <hr>
            <div id="schedule">
            	<h3>Current Schedule</h3>
                <div> 
                	<ul id="schedule_drop" style="min-height:50px; border:1px dotted black";>
                    </ul>
				</div>
            </div>
            <div id="activities">
            	<h3>Activities</h3>
                <ul id="activity_menu">
                	<li><a href="new_activity.php?i_id=<?php echo $_POST['itinerary_id']?>">Create a new activity</a></li>
                </ul>
                <p>Drag and drop your activities onto your schedule</p>
                <ul id="activities_pickup" style="min-height:50px; border:1px dotted black">
                    <li>Eat at Kumos!</li>
                    <li>Visit Peabody Museum</li>
                </ul>
				
            </div>
            </div>
            


			
        <?php
		break; // break the loop, we don't need it anymore
		endif; 
	}
}
?>

<script src="../js/itinerary_functions.js"></script>
<script>

</script>


<?php include("../view/footer.php"); ?>