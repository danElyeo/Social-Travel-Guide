<?php include("../view/header.php"); ?>

<div id="registration_form" class="main_content_area">
	<h2 class="center">Register New User</h2>
	<form action="" method="post">
	<!-- Use a table for formatting purposes -->
	<table style="margin-left:50px;">
    	<tr>
        	<td><label for="first_name">First name:</label></td>
            <td><input type="text" id="first_name" required></td>
        </tr>
        <tr>
        	<td><label for="last_name">Last name:</label></td>
            <td><input type="text" id="last_name" required></td>
        </tr>
        <tr>
        	<td><label for="username">Choose a username:</label></td>
            <td><input type="text" id="username" required></td>
        </tr>
        <tr>
        	<td><label for="password">Choose a password:</label></td>
            <td><input type="password" id="password" required></td>
        </tr>
        <tr>
        	<td><label for="r_password">Repeat password:</label></td>
            <td><input type="password" id="r_password" required></td>
        </tr>
        <tr>
        	<td><label for="email">Email:</label></td>
            <td><input type="email" id="email" required></td>
        </tr>
    </table>
    <p>By clicking the submit button, you agree to the Terms &amp; Conditions and Privacy Policy of the Social Travel Guide. </p>
    <div class="left_indent">
    	<input type="radio" name="agreement">I agree
    	<input type="radio" name="agreement">I do not agree
    </div>
    <br>
    <br>
    <div class="left_indent">
        <input type="submit" value="Submit">
        <input type="reset" value="Clear Form">
    </div>
</form>
</div>

<?php include("../view/footer.php"); ?>