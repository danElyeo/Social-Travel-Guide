<?php include("view/header.php"); ?>
<!-- This page lets the user create an initial travel itinerary. Once the items are filled out, it will create an entry in the SQL database as an itinerary -->


<div id="new_itinerary_form" class="main_content_area">
	<h2 class="text_center">Create a New Travel Plan</h2>
	<form action="" method="post">
    	<table class="center">
        	<tr>
            	<td><label for="title">Title:</label></td>
            	<td><input type="text" id="title" placholder="E.g. Visit San Francisco"></td>
            </tr>
            <tr>
            	<td><label for="destination">Destination:</label></td>
            	<td><input type="text" id="destination"></td>
            </tr>
            <tr>
            	<!-- to be replaced with jQuery DatePicker -->
            	<td><label for="date_from">Date from:</label></td>
            	<td><input type="text" id="date_from"></td>
            </tr>
            <tr>
            	<!-- to be replaced with jQuery DatePicker -->
            	<td><label for="date_to">Date to:</label></td>
            	<td><input type="text" id="date_to"></td>
            </tr>
            <tr>
                <td> </td>
                <td><input type="submit"> <input type="reset"></td>
        	</tr>
        </table>
    </form>
</div>

<?php include("view/footer.php"); ?>