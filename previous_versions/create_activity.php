<?php include("view/header.php") ?>
<!-- This page allows a user to create an activity to consider for their travel itinerary. When a user invite friends to provide suggestions, this is also the page that they will see.-->

<div id="create_activity" class="main_content_area">
<h2 class="text_center">Suggest a Travel Activity</h2>
	<form action="" method="post" >
    <table class="center">
    	<tr>
        	<td><label for="activity_name">Activity Name:</label></td>
            <td><input type="text" id="activity_name"></td>
        </tr>
        <tr>
        	<td><label for="activity_desc">Description:</label></td>
            <td><textarea id="activity_desc" rows="4" cols="50">
</textarea></td>
        </tr>
        <tr>
        	<td><label for="address">Address:</label></td>
            <td>
            	<input type="text" id="address" placeholder="line 1"><br>
                <input type="text" id="address_line2" placeholder="line 2"><br>
                 <input type="text" id="zip_postal" placeholder="ZIP/Postal">
            </td>
        </tr>
        <tr>
        	<td><label for="activity_type">Type:</label></td>
            <td><select id="activity_type">
            	<option value="">Select one</option>
                <option value="dining">Dining</option>
                <option value="accommodation">Accommodation</option>
                <option value="attraction">Attraction</option>
                <option value="scenic">Scenic</option>
                <option value="tip">Travel Tip</option>
                <option value="tour">Tour</option>
                <option value="rental">Car Rental</option>
                <option value="other">Other</option>
            	</select>
            </td>
        </tr>
        <tr>
        	<td><label for="duration">Duration:</label></td>
            <td>
            	<div>
                	<input type="number" id="duration" style="width:30px">hrs
            		<input type="number" style="width:30px;">mins
                </div>
            </td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    	<tr>
        	<td> </td>
            <td><input type="submit"> <input type="reset"></td>
        </tr>
    </table>
    </form>
</div>

<?php include("view/footer.php") ?>