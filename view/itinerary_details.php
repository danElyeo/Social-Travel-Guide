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
	$_SESSION['current_itinerary'] = $_POST['itinerary_id'];	
}
	//echo("Current itinerary id: " . $_POST['itinerary_id']);
    // show the details of only the selected itinerary 
	//print_r($_SESSION['itineraries']);
	// Get the row index of the selected itinerary
	//for ($index = 0; $index < count($_SESSION['itineraries']); $index++)
	
foreach($_SESSION['itineraries'] as $row)
{
	if($row['itinerary_id'] == $_SESSION['current_itinerary']): ?>
		
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
        <!-- Get activities from the database-->
        <?php 
		include("model/activity_db.php");
		$activities = get_activities($_SESSION['current_itinerary']);
		//var_dump($activities);
		
		?>
        
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
				<li><a href="new_activity.php">Create a new activity</a></li>
			</ul>
			<p>Drag and drop your activities onto your schedule</p>
			<ul id="activities_pickup" style="min-height:50px; border:1px dotted black">
            	<?php 
				// Create a row for each activity and add buttons
				foreach ($activities as $row)
				{
					echo "<li a_id='" . $row['activity_id']."' a_name='" . $row['activity_name'] . "'>" . $row['activity_name'];
					echo "<div class='activity_btns'>";
					echo "<input type='button' value='update'>";
					echo "<input type='button' value='delete'>";
					echo "<input type='button' value='add to Schedule'>";
					echo "</div>";
					echo "</li>";	
				}
				?>
                <!--
				<li>Eat at Kumos!</li>
				<li>Visit Peabody Museum</li> -->
			</ul>
			
		</div>
		</div>
	<?php
	break; // break the loop, we don't need it anymore
	endif; 
}

?>

<script src="../js/itinerary_functions.js"></script>
<script>
// for each activity item, add buttons for view/update, delete and add to schedule
$('#activities_pickup li')
	//.append("<div class='activity_btns'></div>")
	.css('border', '1px black solid')
	.css('line-height', '150%');
	
$('.activity_btns')
	.css('float', 'right')
	.css('clear', 'right')
	.css('border', '1px dotted blue');
	
$(".activity_btns input[type='button']").on('click', function(e) {
	//alert('You clicked ' + this.value + ' for ' + $(this).parent().parent().get(0).getAttribute("a_id")); // returns the id of the activity
	var list = $(this).parent().parent().get(0); // returns the list element
	
	switch (this.value) {
		case "update":
			// go to update Activity page
			window.location="./update_activity.php";
		break;
		
		case "delete":
		alert("Are you sure you want to delete the activity: " + list.getAttribute('a_name') + "?");
		break;
		
		case "add to Schedule":
		break;	
	}
});

/*$('.activity_btns')
	.css('float', 'right')
	.css('clear', 'right')
	.css('border', '1px dotted blue');*/
</script>


<?php include("../view/footer.php"); ?>
