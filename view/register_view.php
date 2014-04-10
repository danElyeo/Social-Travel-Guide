<?php
require_once('../util/main.php');
require_once('../util/tags.php');

include("../view/header.php"); 
?>
<div id="registration_form" class="main_content_area">
	<h2 class="center">Register New User</h2>
	<form action="<?php echo $app_path?>model/register_db.php" method="post">
	<!-- Use a table for formatting purposes -->
	<table style="margin-left:50px;">
    	<tr>
        	<td><label for="first_name">First name:</label></td>
            <td><input type="text" id="first_name" name="first_name" required></td>
        </tr>
        <tr>
        	<td><label for="last_name">Last name:</label></td>
            <td><input type="text" id="last_name" name="last_name" required></td>
        </tr>
        <tr>
        	<td><label for="username">Choose a username:</label></td>
            <td><input type="text" id="username" name="username" required></td>
        </tr>
        <tr>
        	<td><label for="password">Choose a password:</label></td>
            <td><input type="password" id="password" name="password" required></td>
        </tr>
        <tr>
        	<td><label for="r_password">Repeat password:</label></td>
            <td><input type="password" id="r_password" name="r_password" required></td>
        </tr>
        <tr>
        	<td><label for="email">Email:</label></td>
            <td><input type="email" id="email" name="email" required></td>
        </tr>
    </table>
    <p>By clicking the submit button, you agree to the Terms &amp; Conditions and Privacy Policy of the Social Travel Guide. </p>
    <div class="left_indent">
    	<input type="radio" name="agreement" required>I agree
    	<input type="radio" name="agreement">I do not agree
    </div>
    <br>
    <br>
    <div class="left_indent">
        <input type="submit" value="Submit">
        <input type="reset" value="Clear Form">
        <input type="button" value="Back" onClick="redirect_home()">
    </div>
</form>
</div>

<script type="text/javascript">
function redirect_home() 
{
	window.location.replace("http://localhost<?php echo $app_path?>");
}
</script>

<?php include("../view/footer.php"); ?>
