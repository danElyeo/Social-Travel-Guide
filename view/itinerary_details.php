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
                <div id="schedule_drop"> 
                	<ul>
                    </ul>
				</div>
            </div>
            <div id="activities">
            	<h3>Activities</h3>
                <p>Drag and drop your activities onto your schedule</p>
                <ul id="activities_pickup">
                    <li>Eat at Kumos!</li>
                    <li>Visit Peabody Museum</li>
                </ul>
				
            </div>
            </div>
            
<script>
/*$("a").click(function(e) {
	e.preventDefault();
});*/

$(function() {
    // there's the gallery and the trash
    var activities_pickup= $( "#activities_pickup" ),
      schedule_drop = $( "#schedule_drop" );
	  
	// let the activity items be draggable
    $( "li", activities_pickup ).draggable({
      cancel: "a.ui-icon", // clicking an icon won't initiate dragging
      revert: "invalid", // when not dropped, the item will revert back to its initial position
      containment: "document",
      helper: "clone",
      cursor: "move"
    });
	
	// let the schedule be droppable, accepting the activity items
    schedule_drop.droppable({
      accept: "#activities_pickup > li",
      activeClass: "ui-state-highlight",
      drop: function( event, ui ) {
		  //alert(ui.draggable);
        addActivityToSchedule( ui.draggable );
      }
    });
	
	// let the activity_pickup be droppable as well, accepting items from the schedule
    activities_pickup.droppable({
      accept: "#schedule_drop li",
      //activeClass: "custom-state-active",
	  activeClass: "ui-state-highlight",
      drop: function( event, ui ) {
        //recycleImage( ui.draggable );
		removeActivityFromSchedule(ui.draggable);
      }
    });
});

function addActivityToSchedule(dropped_item) {
	dropped_item.fadeOut(function() 
	{
		var list = $( "ul", schedule_drop ).length ?
		$( "ul", schedule_drop ) :
		$( "<ul class='ui-helper-reset'/>" ).appendTo(schedule_drop);
		
		// Add the item into the ul in schedule drop
		dropped_item.appendTo(list).fadeIn();
	});
}

function removeActivityFromSchedule(dropped_item) {
	dropped_item.fadeOut(function()
	{
		var list = $("#activities_pickup");
		
		// Add the item into ul in activities_pickup
		dropped_item.appendTo(list).fadeIn();
	});
}
</script>
			
        <?php
		break; // break the loop, we don't need it anymore
		endif; 
	}
}
?>


<?php include("../view/footer.php"); ?>
