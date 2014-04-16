<?php 
require_once('../util/main.php');
include("../view/header.php"); 
?>

<div id="create_ititnerary_form" class="main_content_area">
	<h2 class="center">Create a New Itinerary</h2>
	<form action="<?php echo $app_path?>model/itinerary_db.php" method="post">
	<!-- Use a table for formatting purposes -->
	<table style="margin-left:50px;">
    	<tr>
        	<td><label for="i_name" class="required">Choose a title for your new itinerary:</label></td>
            <td><input type="text" id="i_name" name="i_name" required></td>
        </tr>
        <tr> 
        	<td><label for="i_desc">Description:</label></td>
            <td><textarea rows="4" id="i_desc" name="i_desc"></textarea></td>
        </tr>
        <tr>
        	<td><label for="i_dest" class="required">What's your destination?:</label></td>
            <td><input type="text" id="i_dest" name="i_dest" required></td>
        </tr>
        <tr>
        	<td><label for="start_date" class="required">Start Date:</label></td>
            <td><input type="text" id="start_date" name="start_date" required></td>
        </tr>
        <tr>
        	<td><label for="end_date" class="required">End Date:</label></td>
            <td><input type="text" id="end_date" name="end_date" required></td>
        </tr>
    </table>
    
    <div class="left_indent">
     	<input type="hidden" name="action" value="create_itinerary">
        <input id="submit_button" type="submit" value="Submit">
        <input type="reset" value="Clear Form">
        <input type="button" value="Back" onClick="redirect_home()">
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

function redirect_home() {
	window.location = "<?php echo $host . $app_path; ?>";
}
</script>

<?php include("../view/footer.php"); ?>
