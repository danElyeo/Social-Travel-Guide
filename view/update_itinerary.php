<?php 
require_once('../util/main.php');
include("../view/header.php"); 

if(isset($_POST['itinerary_id']))
{
	$itineraries = $_SESSION['itineraries'];
	$i_name;
	$i_desc;
	$i_dest;
	$i_start;
	$i_end;
	$i_id = $_POST['itinerary_id'];
	foreach($itineraries as $row)
	{
		if($row['itinerary_id'] == 	$_POST['itinerary_id'])
		{
			$i_name = $row['itinerary_name'];	
			$i_desc = $row['itinerary_desc'];
			$i_dest = $row['destination'];
			$i_start = $row['start_date'];
			$i_end = $row['end_date'];
		}
	}
}
?>

<div id="update_itinerary_form" class="main_content_area">
	<h2 class="center">Update Itinerary</h2>
	<form action="<?php echo $app_path?>model/itinerary_db.php" method="post">
	<!-- Use a table for formatting purposes -->
	<table style="margin-left:50px;">
    	<tr>
        	<td><label for="i_name" class="required">Title:</label></td>
            <td><input type="text" id="i_name" name="i_name" value="<?php echo $i_name;?>" required></td>
        </tr>
        <tr> 
        	<td><label for="i_desc">Description:</label></td>
            <td><textarea rows="4" id="i_desc" name="i_desc"><?php echo $i_desc;?></textarea></td>
        </tr>
        <tr>
        	<td><label for="i_dest" class="required">Destination:</label></td>
            <td><input type="text" id="i_dest" name="i_dest" value="<?php echo $i_dest?>" required></td>
        </tr>
        <tr>
        	<td><label for="start_date" class="required">Start Date:</label></td>
            <td><input type="text" id="start_date" name="start_date" value="<?php echo $i_start?>" required></td>
        </tr>
        <tr>
        	<td><label for="end_date" class="required">End Date:</label></td>
            <td><input type="text" id="end_date" name="end_date"  value="<?php echo $i_end?>" required></td>
        </tr>
    </table>
    
    <div class="left_indent">
     	<input type="hidden" name="action" value="update_itinerary">
        <input type="hidden" name="i_id" value="<?php echo $_POST['itinerary_id'];?>">
        <input id="submit_button" type="submit" value="Update" disabled="true">
        <input type="button" value="Cancel" onClick="go_back()">
    </div>
</form>
</div>


<script>
$(function() {
	$( "#start_date" ).datepicker();
});

$(function() {
	$( "#end_date" ).datepicker();
});

$('#update_itinerary_form').on('change', function(e) {
		//console.log('Something was changed ' + e.target);
		$('#submit_button').removeAttr('disabled');
});

function go_back() {
	window.location = "<?php echo $host . $app_path; ?>";
}
</script>

<?php include("../view/footer.php"); ?>
