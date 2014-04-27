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
        <!-- This hidden form facilitates updating of activities for the update_activity.php page -->
        <form id="activity_update_form" action="update_activity.php" method="post">
            <input type="hidden" name="action" value="update_activity">
            <input type="hidden" name="a_id" value="">
            <input type="hidden" name="a_name" value="">
            <input type="hidden" name="a_desc" value="">
            <input type="hidden" name="a_author" value="">
            <input type="hidden" name="a_type" value="">
            <input type="hidden" name="a_addr1" value="">
            <input type="hidden" name="a_addr2" value="">
            <input type="hidden" name="a_addr3" value="">
            <input type="hidden" name="a_dur_day" value="">
            <input type="hidden" name="a_dur_hr" value="">
            <input type="hidden" name="a_dur_min" value="">
        </form>
		<div id="activities">
			<h3>Activities</h3>
			<ul id="activity_menu">
				<li><a href="new_activity.php">Create a new activity</a></li>
			</ul>
			<p>Drag and drop your activities onto your schedule</p>
			<!--<ul id="activities_pickup" style="min-height:50px; border:1px dotted black">-->
            <div id="activities_pickup" class="accordion">
            	<?php 
				// Create a row for each activity and add buttons
				foreach ($activities as $row)
				{
					// used with ul instead of div
					/*echo "<li a_id='" . $row['activity_id']."' a_name='" . $row['activity_name'] . "'>" . $row['activity_name'];
					echo "<div class='activity_btns'>";
					echo "<input type='button' value='update'>";
					echo "<input type='button' value='delete'>";
					echo "<input type='button' value='add to Schedule'>";
					echo "</div>";
					echo "</li>";	*/
					
					echo "<div class='header' a_id='" . $row['activity_id']."' a_name='" . $row['activity_name'] . "'>" . $row['activity_name'];
					echo "<div class='activity_btns'>";
					echo "<input type='button' value='update'>";
					echo "<input type='button' value='delete'>";
					echo "<input type='button' value='add to Schedule'>";
					echo "</div>"; // end div class='activity_btns'
					echo "</div>"; // end div class='header'
					
					echo "<div class='content'>";
					echo "<table><tr>";
					echo "<th>Description</th>";
					echo "<th>Author</th>";
					echo "<th>Type</th>";
					echo "<th>Address</th>";
					echo "<th>Duration</th>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>" . $row['activity_desc'] . "</td>";
					echo "<td>" . $row['author'] . "</td>";
					echo "<td>" . $row['activity_type'] . "</td>";
					
					if(empty($row['activity_addr1']) && empty($row['activity_addr2']) && empty($row['activity_addr1']))
					{
						echo "<td>-</td>"; 	
					}
					else
					{
						echo "<td>" . $row['activity_addr1'] . $row['activity_addr2'] . $row['activity_addr3'] . "</td>";
					}
					
					echo "<td>";
					if($row['duration_days'] != 0)
					{
						echo $row['duration_days'] . " days ";
						//echo "<br>";	
					}
					if($row['duration_hrs'] != 0)
					{
						echo $row['duration_hrs'];
						if ($row['duration_hrs'] == 1)
						{
							echo " hour ";
						} else {
							echo " hours ";	
						}
					}
					if($row['duration_mins'] != 0)
					{
						echo $row['duration_mins'] . " mins";
						//echo "<br>";	
					}
					if($row['duration_days'] == 0 && $row['duration_hrs'] == 0 && $row['duration_mins'] == 0)
					{
						echo "-";	
					}
					echo "</td>";
					echo "</tr></table>";
					echo "</div>"; // end div class='content';
				}
				?>
                <!--
				<li>Eat at Kumos!</li>
				<li>Visit Peabody Museum</li> -->
			<!-- </ul> -->
            </div> <!-- end activities_pickup -->
			
		</div>
		</div>
	<?php
	break; // break the loop, we don't need it anymore
	endif; 
}

?>

<script src="../js/itinerary_functions.js"></script>
<script>
// save PHP activities into Javascript activities
var activities = JSON.parse('<?php echo json_encode($activities,JSON_HEX_TAG|JSON_HEX_APOS); ?>');
//console.log(activities);

// for each activity item, add buttons for view/update, delete and add to schedule
$('#activities_pickup > div')
	//.append("<div class='activity_btns'></div>")
	.css('border', '1px black solid')
	.css('line-height', '150%');
	
$('.activity_btns')
	.css('float', 'right')
	.css('clear', 'right')
	//.css('border', '1px dotted blue');
	
$(".activity_btns input[type='button']").on('click', function(e) {
	//alert('You clicked ' + this.value + ' for ' + $(this).parent().parent().get(0).getAttribute("a_id")); // returns the id of the activity
	e.preventDefault();
	
	
	var list = $(this).parent().parent().get(0); // returns the list element
	
	switch (this.value) {
		case "update":
			// find out which activity to update
			var chosenEntry;
			activities.forEach(function(entry)
			{
				if(entry['activity_id'] == list.getAttribute('a_id'))
				{
					chosenEntry = entry;
					console.log(chosenEntry);
				}
			});
			
			// send details of chosen entry to the update_activity_form
			//var input = $('#activity_update_form > input');
			$('#activity_update_form > input[name="action"]').val("update_activity");
			$('#activity_update_form > input[name="a_id"]').val(chosenEntry['activity_id']);
			$('#activity_update_form > input[name="a_name"]').val(chosenEntry['activity_name']);
			$('#activity_update_form > input[name="a_desc"]').val(chosenEntry['activity_desc']);
			$('#activity_update_form > input[name="a_author"]').val(chosenEntry['author']);
			$('#activity_update_form > input[name="a_type"]').val(chosenEntry['activity_type']);
			$('#activity_update_form > input[name="a_addr1"]').val(chosenEntry['activity_addr1']);
			$('#activity_update_form > input[name="a_addr2"]').val(chosenEntry['activity_addr2']);
			$('#activity_update_form > input[name="a_addr3]').val(chosenEntry['activity_addr3']);
			$('#activity_update_form > input[name="a_dur_day"]').val(chosenEntry['duration_days']);
			$('#activity_update_form > input[name="a_dur_hr"]').val(chosenEntry['duration_hrs']);
			$('#activity_update_form > input[name="a_dur_min"]').val(chosenEntry['duration_mins']);
			
			$('#activity_update_form').submit();
			// go to update Activity page
			//window.location="./update_activity.php";
			//alert("Updating for activity id: " + list.getAttribute('a_id'));
			
		break;
		
		case "delete":
		confirm("Are you sure you want to delete the activity: " + list.getAttribute('a_name') + "?");
		break;
		
		case "add to Schedule":
		break;	
	}
	
	return false; // so that it does not bubble up to the accordion
});

/*$('.activity_btns')
	.css('float', 'right')
	.css('clear', 'right')
	.css('border', '1px dotted blue');*/
	
$(function() {
	$( ".accordion" ).accordion({
	  collapsible: true,
	  active:false
	});
});

$('#activities_pickup table tr td:first-child').css('width', '15em');

$('td, th')
	.css('font-size', '0.75em')
	.css('text-align','left')
	.css('padding-right', '10px')
	.css('line-height', '1.5em')
	.css('vertical-align', 'top');

$('th').css('color', 'maroon');

</script>


<?php include("../view/footer.php"); ?>
