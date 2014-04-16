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
    <ul>
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
    	<form action="view/itinerary_details.php" method="post">
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
			echo "<td><button value='" . $row['itinerary_id'] . "'>view</button>";
			echo "</tr>";
		}	
		?>
        </table>
        </form>
    </div>
    
    <?php else: ?>
    
    <?php endif ?>
    
    

<script>
function create_itinerary(e) 
{
	e.preventDefault();
	$.ajax({
		url: 'actions.php',
		type: 'post',
		data: {'change_state': 'new_itinerary'},
		success: function(){
			location.reload();
		}
    }); // end ajax call
}

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


$(document).ready(function() {
	$("button").click(function(e)
	{
		e.preventDefault();
		
		$('table').after("<input type='hidden' name='itinerary_id' value="+ this.value +">");	// dynamically creates the input field based on which button is clicked.
		$('form').submit(); // submits the form
	});
});
</script>