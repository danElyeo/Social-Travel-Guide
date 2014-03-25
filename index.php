<?php
require_once('util/main.php');
require_once('util/tags.php');
require_once('model/database.php');

include("header.php"); 

// debug
//echo "Current username is: " . $_SESSION['username'] . "<br/>";
//echo "Current user_id is: " . $_SESSION['user_id'] . "<br/>";

?>
<!-- Depending on the state of the site, main content area will change -->
<div class="main_content_area">
<?php // if user is  logged in, show user dashboard
if(isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>

	<p>Welcome, <?php echo $_SESSION['username']; ?>, to the Social Travel Guide, the site where you ask your friends and social network to suggest activities and plan your travel itinerary for you! </p>

<?php else: // otherwise, show the log in view ?>
	<p>Welcome to the Social Travel Guide, the site where you ask your friends and social network to suggest activities and plan your travel itinerary for you! </p>
    
    <div id="login_container">
        <p>To start off, login here to start viewing and planning for your trips!</p>
        <form action="login.php" method="post" class="left_indent">
            <table>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td> </td>
                    <td><input type="submit" value="Login"></td> <!-- functions located at footer -->
                </tr>
            </table>
        </form>
    </div>
    
    <div>
        <p>Not a member? Click <a href="register.php">here</a> to register for free now!</p>
    </div>
    
    <?php endif ?>
    
</div>

<script>
function check_login() {
	alert("Login button has been clicked");	
}
</script>

<?php include("footer.php"); ?>






