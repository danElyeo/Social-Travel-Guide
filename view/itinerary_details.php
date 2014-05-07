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
			<div id="schedule_drop" class="accordion"> 
				<?php 
				// Create a row for each activity and add buttons
				foreach ($activities as $row)
				{
					if($row['in_schedule'] == 1) {
						echo "<div class='header' a_id='" . $row['activity_id']."' a_name='" . $row['activity_name'] . "'>" . $row['activity_name'];
						echo "<div class='activity_btns'>";
						echo "<input type='button' value='update'>";
						echo "<input type='button' value='delete'>";
						echo "<input class='removeSchedule'type='button' value='remove from Schedule'>";
						echo "</div>"; // end div class='activity_btns'
						echo "</div>"; // end div class='header'
						
						echo "<div class='content' a_id='" . $row['activity_id']."'>";
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
							echo "<td>" . $row['activity_addr1'] . $row['activity_addr2'] . "<br>" . $row['activity_addr3'];
							
							if(!empty($row['activity_addr1']) && !empty($row['activity_addr3'])) {
								// include the option to view the map if address 1 and/or 3 are populated. Nothing if not.
								echo "<br><span ><a class='fMap' href='' onclick='getLatLng();' a_name='" .$row['activity_name'] ."' addr1='" .$row['activity_addr1'] ."' addr3='" . $row['activity_addr3'] . "'>view map</a></span>";
							}
							
							echo "</td>";
						}
						
						echo "<td>";
						if($row['duration_days'] != 0)
						{
							echo $row['duration_days'];
							if ($row['duration_days'] == 1)
							{
								echo " day ";
							} else {
								echo " days ";	
							}	
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
					}// end if in_schedule is 0;
				}
				?>
			</div>
		</div>
        <!--
        <div id="map-canvas" style="width:800; height:600; border:1px solid black;">
        <a class="fMap" href="" onclick="return false;">View location map </a>
        </div>-->
        
        <!--<a class="fMap" href="" onclick="return false;">View location map </a>-->
        
        
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
			<ul id="activity_menu" style="list-style-type:none">
				<li><a href="new_activity.php">Create a new activity</a></li>
			</ul>
			
			<!--<ul id="activities_pickup" style="min-height:50px; border:1px dotted black">-->
            <div id="activities_pickup" class="accordion">
            	<?php 
				// Create a row for each activity and add buttons
				foreach ($activities as $row)
				{
					if($row['in_schedule'] == 0) {
						echo "<div class='header' a_id='" . $row['activity_id']."' a_name='" . $row['activity_name'] . "'>" . $row['activity_name'];
						echo "<div class='activity_btns'>";
						echo "<input type='button' value='update'>";
						echo "<input type='button' value='delete'>";
						echo "<input class='addSchedule' type='button' value='add to Schedule'>";
						echo "</div>"; // end div class='activity_btns'
						echo "</div>"; // end div class='header'
						
						echo "<div class='content' a_id='" . $row['activity_id']."'>";
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
							echo "<td>" . $row['activity_addr1'] . $row['activity_addr2'] . "<br>" . $row['activity_addr3'];
							
							if(!empty($row['activity_addr1']) && !empty($row['activity_addr3'])) {
								// include the option to view the map if address 1 and/or 3 are populated. Nothing if not.
								echo "<br><span ><a class='fMap' href='' onclick='getLatLng();' a_name='" .$row['activity_name'] ."' addr1='" .$row['activity_addr1'] ."' addr3='" . $row['activity_addr3'] . "'>view map</a></span>";
							}
							
							echo "</td>";
						}
						
						echo "<td>";
						if($row['duration_days'] != 0)
						{
							echo $row['duration_days'];
							if ($row['duration_days'] == 1)
							{
								echo " day ";
							} else {
								echo " days ";	
							}	
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
					}// end if in_schedule is 0;
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
		var confirm_delete = confirm("Are you sure you want to delete the activity: " + list.getAttribute('a_name') + "?");
		if(confirm_delete)
		{
			$.ajax({
				url: '../model/activity_db.php',
				type: 'POST',
				data: {	name: 'action',
						action: 'delete_activity',
						a_id : list.getAttribute('a_id') 
				},
				success: function(data){
					//location.reload();
					//alert(data);
					//console.log("Data returned: " + data);
					if(data) // 1 is a success
					{
						location.reload();
					}
				}
   			}); // end ajax call
		}
		break;
		
		case "add to Schedule":
		$.ajax({
				url: '../model/activity_db.php',
				type: 'POST',
				data: {	name: 'action',
						action: 'add_to_schedule',
						a_id : list.getAttribute('a_id') 
				},
				success: function(data){
					//location.reload();
					//alert("Added to schedule");
					//console.log("Data returned: " + data);
					if(data) // 1 is a success
					{
						//location.reload();
						// move activity to schedule list
						$('div.header').each(function() {
							//console.log("Activity ID is " + $(this).attr('a_id'));
							if($(this).attr('a_id') == list.getAttribute('a_id')) {
								$('#schedule_drop').append($(this));
								// Change add to Schedule button to remove from Schedule
								$(this).find('input.addSchedule')
								.val('remove from Schedule')
								.removeClass('addSchedule')
								.addClass('removeSchedule');
								
								// Append the corresponding content block to the Schedule as well
								$('div.content').each(function() {
									if($(this).attr('a_id') == list.getAttribute('a_id')) {
										$('#schedule_drop').append($(this));
									}
								});
								
								
							}
						});
					}
				}
   			}); // end ajax call
		break;
		
		case "remove from Schedule":
		$.ajax({
				url: '../model/activity_db.php',
				type: 'POST',
				data: {	name: 'action',
						action: 'remove_from_schedule',
						a_id : list.getAttribute('a_id') 
				},
				success: function(data){
					//location.reload();
					//alert("removing from schedule");
					//console.log("Data returned: " + data);
					if(data) // 1 is a success
					{
						//location.reload();
						// move activity to schedule list
						$('div.header').each(function() {
							//console.log("Activity ID is " + $(this).attr('a_id'));
							if($(this).attr('a_id') == list.getAttribute('a_id')) {
								$('#activities_pickup').append($(this));
								// Change add to Schedule button to remove from Schedule
								$(this).find('input.removeSchedule')
								.val('add to Schedule')
								.removeClass('removeSchedule')
								.addClass('addSchedule');
								
								// Append the corresponding content block to the Schedule as well
								$('div.content').each(function() {
									if($(this).attr('a_id') == list.getAttribute('a_id')) {
										$('#activities_pickup').append($(this));
									}
								});
								
								
							}
						});
					}
				}
   			}); // end ajax call
		
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

$('.accordion td, .accordion th')
	.css('font-size', '0.75em')
	.css('text-align','left')
	.css('padding-right', '10px')
	.css('line-height', '1.5em')
	.css('vertical-align', 'top');

$('th').css('color', 'maroon');

$('td span').css('vertical-align', 'bottom');

</script>

<script>
// Google maps popup code
//var lat; // to store the return latlng from geocoder
//var lng;
//var full_address;
//var geocoder;
//var mapG;
//loadScriptGeneral();

$(document).ready(function () {
	
	
	var clickedLink = $(".fMap");
	
	clickedLink.colorbox({
		html:'<div id="map_canvas_all" style="width:600px; height:450px;"></div>',
		scrolling:false,
		width:"600px",
		height:"470px",
		onComplete:function(){
			//alert("Only called once!");
			var address1 = $(this).attr('addr1');
			var ZIP = $(this).attr('addr3');
			full_address = address1 + " " +  ZIP; 
			//alert("Address: " + full_address);
			initializeGeneral(full_address);	
		}
	})
	/*clickedLink.on("click", function() {
		//var activityName = $(this).attr('a_name');
		var address1 = $(this).attr('addr1');
		var ZIP = $(this).attr('addr3');
		full_address = address1 + " " +  ZIP; 
		//alert("Address: " + full_address);
		initializeGeneral(full_address);
		
		//var geocoder = new google.maps.Geocoder();
		//codeAddress(full_address, geocoder);
	});*/
	
	
});

/*function loadScriptGeneral() {
	console.log("Map script loaded");
	var script = document.createElement("script");
	script.type = "text/javascript";
	//script.src = "http://maps.google.com/maps/api/js?sensor=false&callback=initializeGeneral";
	script.src = "http://maps.google.com/maps/api/js?sensor=false";
	document.body.appendChild(script);
};
*/
function initializeGeneral(full_address) {
	
  	// get the geocode for the full addresss
	var geocoder = new google.maps.Geocoder();
	codeAddress(full_address, geocoder);
  
	//var myLatlngG = new google.maps.LatLng(35.518421,24.018758)
};

function getLatLng()
{
	event.preventDefault();
	//console.log(event.target['addr1']);
	//geocoder = new google.maps.Geocoder();
}

function codeAddress(address, geocoder) {
    //In this case it gets the address from an element on the page, but obviously you  could just pass it to the method instead
    //var address = document.getElementById("address").value;

    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        //In this case it creates a marker, but you can get the lat and lng from the location.LatLng
		//alert(results[0].geometry.location);
		var lat = results[0].geometry.location.lat();
		var lng = results[0].geometry.location.lng();
		
		var myLatlngG = new google.maps.LatLng(lat,lng);
		//alert(myLatlngG);
		var myOptionsG = {
			zoom: 16,
			center: myLatlngG,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
	  
	  	//if(mapG != null)
		//{
		var mapG = new google.maps.Map(document.getElementById("map_canvas_all"), myOptionsG);
		//}
		
		var marker = new google.maps.Marker({
			map: mapG, 
			position:myLatlngG
		});
		
		$('#map_canvas_all').on('shown', function () {
       	 	google.maps.event.trigger(mapG, "resize");
		 	mapG.setCenter(myLatLng);
   	 	});
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
</script>

<?php include("../view/footer.php"); ?>
