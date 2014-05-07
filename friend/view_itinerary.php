<!-- This is the friend page. It is similar to the itinerary details page -->
<?php
require_once('../util/main.php'); // starts the session
require_once('../util/tags.php');
require_once('../model/database.php');

include("../view/header.php"); 

// If the itinerary id has been set, show the details, as well as its activities
// Get the user id and 
if(isset($_GET['i_id']))
{
	//$user_id = $_GET['u_id'];
	$i_id = $_GET['i_id'];
	
	// Get itinerary details from the database
	include("../model/itinerary_db.php");
	$details = get_details($i_id);
	$first_row = $details[0];
	//print_r($details);
	
	// Get the activities from the database
	include("../model/activity_db.php");
	$activities = get_activities($i_id);
	//print_r($activities);
}
?>

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
            <td><?php echo $first_row['itinerary_name']; ?></td>
            <td><?php echo $first_row['itinerary_desc']; ?></td>
            <td><?php echo $first_row['destination']; ?></td>
            <td><?php echo $first_row['start_date']; ?></td>
            <td><?php echo $first_row['end_date']; ?></td>
        </tr>
    </table>
   
    <br>
    <hr>
    <div id="schedule">
        <h3>Current Schedule</h3>
        <div id="schedule_drop" class="accordion"> 
            <?php 
            // Create a row for each activity and add buttons
            foreach ($activities as $row)
            {
                if($row['in_schedule'] == 1) {
                    echo "<div class='header' a_id='" . $row['activity_id']."' a_name='" . $row['activity_name'] . "'>" . $row['activity_name'];
                    //echo "<div class='activity_btns'>";
                    //echo "<input type='button' value='update'>";
                    //echo "<input type='button' value='delete'>";
                    //echo "<input class='removeSchedule'type='button' value='remove from Schedule'>";
                    //echo "</div>"; // end div class='activity_btns'
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
        </div> <!-- end schedule_drop -->
	</div> <!-- end schedule -->
    <div id="activities">
        <h3>Activities</h3>
        <ul id="activity_menu" style="list-style-type:none">
            <li><a href="add_suggestion.php?i_id=<?php echo $i_id;?>">Add a suggestion</a></li>
        </ul>
        
        <!--<ul id="activities_pickup" style="min-height:50px; border:1px dotted black">-->
        <div id="activities_pickup" class="accordion">
            <?php 
            // Create a row for each activity and add buttons
            foreach ($activities as $row)
            {
                if($row['in_schedule'] == 0) {
                    echo "<div class='header' a_id='" . $row['activity_id']."' a_name='" . $row['activity_name'] . "'>" . $row['activity_name'];
                    //echo "<div class='activity_btns'>";
                    //echo "<input type='button' value='update'>";
                    //echo "<input type='button' value='delete'>";
                    //echo "<input class='addSchedule' type='button' value='add to Schedule'>";
                    //echo "</div>"; // end div class='activity_btns'
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
        </div> <!-- end activities_pickup -->     
    </div>
</div>

<script>
// save PHP activities into Javascript activities
var activities = JSON.parse('<?php echo json_encode($activities,JSON_HEX_TAG|JSON_HEX_APOS); ?>');
//console.log(activities);

// for each activity item, add buttons for view/update, delete and add to schedule
$('#activities_pickup > div')
	//.append("<div class='activity_btns'></div>")
	.css('border', '1px black solid')
	.css('line-height', '150%');
	

	
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
});

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