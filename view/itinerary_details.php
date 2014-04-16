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
            <div id="current_schedule">
            	<h3>Current Schedule</h3>
                <div id="droppable" class="ui-widget-header">
  					<p>Drop here</p>
				</div>
            </div>
            <div id="activities">
            	<h3>Activities</h3>
                <ul>
                	<li><a href="">Create a new activity</a></li>
                    <li><a href="">Ask your friends for suggestions</a></li>
                </ul>
                <!-- Show the current activities table -->
                <div id="draggable" class="ui-widget-content">
  					<p>Drag me to my target</p>
				</div>
				
            </div>
            </div>
            
            <script>
			$("a").click(function(e) {
				e.preventDefault();
			});
			
			$(function() {
				$( "#draggable" ).draggable();
				$( "#droppable" ).droppable({
				 	drop: function( event, ui ) {
					$( this )
					  .addClass( "ui-state-highlight" )
					  .find( "p" )
						.html( "Dropped!" );
				 	}
				});
			});
			</script>
			
        <?php
		break; // break the loop, we don't need it anymore
		endif; 
	}
}
?>


<?php include("../view/footer.php"); ?>
