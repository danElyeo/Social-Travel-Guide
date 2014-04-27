<?php 
require_once('../util/main.php');
include("../view/header.php"); 

// Get the values from the previous page
/*if(isset($_POST['action']) &&
	isset($_POST['a_id']) &&
	isset($_POST['a_name']))
{
		
}*/
?>

<div id="update_activity_form" class="main_content_area">
	<h2 class="center">Update Activity</h2>
	<form id="update_form" action="<?php echo $app_path?>model/activity_db.php" method="post">
	<!-- Use a table for formatting purposes -->
	<table style="margin-left:50px;">
    	<tr>
        	<td><label for="a_name" class="required">Title:</label></td>
            <td><input type="text" id="a_name" name="a_name" value="<?php echo $_POST['a_name'];?>" required></td>
        </tr>
        <tr> 
        	<td><label for="a_desc">Description:</label></td>
            <td><textarea rows="4" id="a_desc" name="a_desc"><?php echo $_POST['a_desc'];?></textarea></td>
        </tr>
        <tr> 
        	<td><label for="a_type">Type:</label></td>
            <td>
            	<select name="a_type" id="a_type">
                	<option value=""></option>
                    <option value="dining">Dining</option>
                    <option value="accommodation">Accomodation</option>
                    <option value="attraction">Attraction</option>
                    <option value="scenic drive">Scenic Drive</option>
                    <option value="museum">Museum</option>
                    <option value="tip">Travel Tip</option>
                    <option value="tour">Tour</option>
                	<option value="rental">Car Rental</option>
                    <option value="other">Other</option>
                </select>
                <br>
                <input type="textfield" id="other_activity" hidden="true" placeholder="Please state the type">
            </td>
        </tr>
        <tr>
        	<td rowspan="3"><label for="a_address1">Address:</label></td>
            <td><input type="text" id="a_address1" name="a_address1" placeholder="Street name" value="<?php echo $_POST['a_addr1'];?>"></td>
        </tr>
        <tr>
            <td><input type="text" id="a_address2" name="a_address2"placeholder="unit no." value="<?php echo $_POST['a_addr2'];?>"></td>
        </tr>
        <tr>
            <td><input type="text" id="a_address3" name="a_address3" placeholder="ZIP/Postal" value="<?php echo $_POST['a_addr3'];?>"></td>
        </tr>
        <tr>
        	<td><label for="days">Duration:</label></td>
            <td>
           		<input id="days" name="days" type="number" min="0" value="<?php echo $_POST['a_dur_day'] == 0 ? '': $_POST['a_dur_day'];?>"> day(s)
            	<select id="hours" name="hours">
                	<option value=""></option>
                </select> hour(s)
                <select id="mins" name="mins">
                	<option value=""></option>
                </select> min(s)
            </td>
        </tr>
    </table>
    <br>
    <div class="left_indent">
     	<input type="hidden" name="action" value="update_activity">
        <input type="hidden" name="a_id" value="<?php echo $_POST['a_id'];?>">
        <input id="update_button" type="submit" value="Update" disabled="true">
        <input type="button" value="Cancel" onClick="">
    </div>
</form>
</div>

<script>

$(document).ready(function() {
	// When users choose Other in Activity type, create a textfield for 	them to type manually
	$('#a_type').change(function() {
		if(this.value == "other") {
			$('#other_activity').show();
		}
		else {
			$('#other_activity').hide();	
		}
	});
	
	$('#update_form').on('change', function(e) {
		console.log('Something was changed ' + e.target);
		$('#update_button').removeAttr('disabled');
	});
	
	var count = 0; // count helps to check if the type is present in the predefined list. If it is not, it will appear as an other and within the textfield.
 	//console.log("Type is <?php echo $_POST['a_type']?>");
	$('#a_type option').each(function() {
		if(this.value == "<?php echo $_POST['a_type']?>")
		{
			this.selected = true;
			count++;
		}
	});
	
	if(count == 0)
	{
		$('#a_type option[value="other"]').attr('selected', 'selected');
		$('#other_activity').show().val("<?php echo $_POST['a_type']?>");	
	}
	
	// Create the days, hours and mins options
	// Set the width of the days textfield
	$('#days').css('width', 30);
	
	// Set the number of hours in the hours select tag
	for (var h = 0; h < 24; h++)
	{
		$('#hours').append('<option value=' + h + '>' + h + '</option>');
	}
	
	// Set the number of mins in the mins select tag
	// show only 0, 15, 30 and 45 mins
	for (var m = 0; m < 4; m++)
	{
		$('#mins').append('<option value=' + m*15 + '>' + m*15 + '</option>');
	}
	
	// Set the number of hours and mins according to the posted data
	<?php 
	if ($_POST['a_dur_hr'] != 0):?>
	$('#hours').val(<?php echo $_POST['a_dur_hr'];?>);
	<?php endif ?>
	
	<?php 
	if ($_POST['a_dur_min'] != 0):?>
	$('#mins').val(<?php echo $_POST['a_dur_min'];?>);
	<?php endif ?>
});


</script>

<?php include("../view/footer.php"); ?>
