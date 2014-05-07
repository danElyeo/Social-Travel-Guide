<?php
// If itinerary_ids array is already set, unset and create a new one. 
if(isset($_SESSION['itineraries'])) 
{
	unset($_SESSION['itineraries']);
	
}
$_SESSION['itineraries'] = array();
?>

	<p>Welcome, <?php echo $_SESSION['username']; ?>, to the Social Travel Guide! </p>

    <!-- Show a menu that allows user to log out -->
    <ul style="list-style-type:none";>
    	<li><a href="view/new_itinerary.php">Create a new itinerary</a></li>
    	<li><a href="" onclick="logout(); return false;">Log out</a></li>
    </ul>
    <!-- Get number of itineraries the user have from the database -->
    <?php 
	include("model/itinerary_db.php");
	$itineraries = get_itineraries($_SESSION['user_id']); // get itinerary details from the database
	$_SESSION['itineraries'] = $itineraries;
	//print_r($itineraries);
	?>
    <p>You currently have <?php echo(count($itineraries)); ?> 
    <?php 
		if(count($itineraries) == 1) 
		{
			echo "itinerary.";	
		} 
		else 
		{
			echo "itineraries.";	
		}
	?>
    </p>
    
<!-- If there are itineraries, show them in table form. Otherwise
	show a link/button to create a new itinerary	-->
    <?php if(count($itineraries) > 0): ?>
    <div id="itinerary_details">
    	<form action="" method="post"><!-- form action to be set by javascript -->
    	<table id="itinerary_table">
        	<tr>
            	<th>Name</th>
                <th>Description</th>
                <th>Destination</th>
                <th>Start date</th>
                <th>End date</th>
            </tr>
        <!-- create a row for each itinerary-->
        <?php 
		foreach($itineraries as $row)
		{
			echo "<tr>";
			// Create a column for each detail
			echo "<td>" . $row['itinerary_name'] . "</td>";
			echo "<td>" . $row['itinerary_desc'] . "</td>";
			echo "<td>" . $row['destination'] . "</td>";
			echo "<td>" . $row['start_date'] . "</td>";
			echo "<td>" . $row['end_date'] . "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td colspan='5'><button id='view_btn' value='" . $row['itinerary_id'] . "'>view</button>
			<button id='update_btn' value='" . $row['itinerary_id'] . "'>update</button>
			<button id='share_btn' value='" . $row['itinerary_id'] . "'>share</button>
			<button id='delete_btn' value='" . $row['itinerary_id'] . "'>delete</button><hr></td>";
			echo "</tr>";
		}
		?>
        </table>
        <input id="i_id" type="hidden" name="itinerary_id" value="">
        </form>
    </div>
    
    <?php endif; ?>
    
	<div id="share_dialog" title="Sharing your itinerary">
        <p>To share your itinerary and ask your friends for suggestions, simply copy the text block below. You may paste the text block in an email or on a Facebook post. The link will direct your friends to a special page that allows them to view your itinerary add suggestions. Happy planning!</p>
        <div id="textblock" style="border:1px solid black; padding:10px;">
        	<p>Hello friend!</p>
            <p id="custom_text"></p>
            <p id="custom_link"></p>
        </div>
	</div>
<script>

function logout()
{
	//alert("Calling logout");
	$.ajax({
		url: 'actions.php',
		type: 'post',
		data: {'action': 'logout'},
		success: function(data){
			location.reload();
			//alert(data);
		}
    }); // end ajax call
}

function get_destination(i_id)
{
	$.ajax({
		url: 'model/itinerary_db.php',
		type: 'post',
		data: {
			'i_id': i_id, 
			'action':'get_destination'
		},
		success: function(data){
			//location.reload();
			//alert(data);
			//return data;
			$('#custom_text').html("I am planning to travel to " + data + " soon and I would appreciate any suggestions you have about that place. What are some nice places to see and fun things to do? Click on the link below to view my itinerary and add your tips! Thanks!");
			
			$('#custom_link').html("http://localhost/cs601/project/friend/view_itinerary.php?i_id=" + i_id)
		}
    }); // end ajax call	
}


$(document).ready(function() {
	$( "#share_dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 500
      },
      hide: {
        effect: "fade",
        duration: 500
      },
	  model:true,
	  width:600
    }).css("font-size", "0.75em");
 
    $( "#share_btn" ).click(function() {
      $( "#share_dialog" ).dialog( "open" );
    });
	
	$("button").click(function(e)
	{
		e.preventDefault();
		// Set the selected itinerary id
		$('#i_id').val(this.value);
		//console.log(e.target.id);
		switch(e.target.id)
		{
			case "view_btn":
				$('form').attr("action", "view/itinerary_details.php")
					.submit();
			break;
			
			case "update_btn":
			$('form').attr("action", "view/update_itinerary.php")
					.submit();
			break;
			
			case "share_btn":
			//alert("Sharing feature is coming soon! Stay tuned!");
			//alert(e.target);
			var destination = get_destination(this.value);
			break;
			
			case "delete_btn":
				var confirm_delete = confirm("Warning! This action will permanently delete this itinerary, including ALL its activities. Are you sure you want to do this?");
				if(confirm_delete)
				{
					$.ajax({
						url: 'model/itinerary_db.php',
						type: 'POST',
						data: {	name: 'action',
								action: 'delete_itinerary',
								i_id : this.value
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
		}
		
	});
});
</script>