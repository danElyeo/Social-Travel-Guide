<?php 
require_once('../util/main.php');
include("../view/header.php"); 

?>

<div id="create_activity_form" class="main_content_area">
	<h2 class="center">Create a New Activity/Suggestion</h2>
	<form action="<?php echo $app_path?>model/activity_db.php" method="post">
	<!-- Use a table for formatting purposes -->
	<table style="margin-left:50px;">
    	<tr>
        	<td><label for="a_name" class="required">Choose a title for your activity:</label></td>
            <td><input type="text" id="a_name" name="a_name" required></td>
        </tr>
        <tr> 
        	<td><label for="a_desc">Please describe your activity:</label></td>
            <td><textarea rows="4" id="a_desc" name="a_desc"></textarea></td>
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
        	<td rowspan="3"><label for="a_address1">Can you provide an address?</label></td>
            <td><input type="text" id="a_address1" name="a_address1" placeholder="Street name"></td>
        </tr>
        <tr>
            <td><input type="text" id="a_address2" name="a_address2"placeholder="unit no."></td>
        </tr>
        <tr>
            <td><input type="text" id="a_address3" name="a_address3" placeholder="ZIP/Postal"></td>
        </tr>
        <tr>
        	<td><label for="days">How long should this activity take?</label></td>
            <td>
           		<input id="days" name="days" type="number" min="0"> day(s)
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
     	<input type="hidden" name="action" value="create_activity">
        <input id="submit_button" type="submit" value="Submit">
        <input type="reset" value="Clear Form">
        <input type="button" value="Back" onClick="redirect_home()">
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
});


</script>

<?php include("../view/footer.php"); ?>
