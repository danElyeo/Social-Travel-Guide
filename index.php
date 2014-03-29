<?php
require_once('util/main.php'); // starts the session
require_once('util/tags.php');
require_once('model/database.php');

include("header.php"); 

// debug
//echo "Current username is: " . $_SESSION['username'] . "<br/>";
//echo "Current user_id is: " . $_SESSION['user_id'] . "<br/>";
if(!isset($_SESSION['state']))
{
	$_SESSION['state'] = "login";	
}
?>
<!-- Depending on the state of the site, main content area will change -->
<div class="main_content_area">
<?php 
	// Check the current state of the session and display views according the current state
	switch($_SESSION['state'])
	{
		case "login":
			include("view/login_view.php");
		break;
		
		case "invalid_login":
			include("view/login_view.php");
		break;
		
		case "register_user":
			include("view/register_view.php");
		break;
		
		case "user_dashboard":
			include("view/dashboard_view.php");
		break;
		
		default:
			include("view/login_view.php");
		break;	
	}
?>

<?php // Check if user has previously logged out
	if(isset($_GET['logout']))
	{
		if($_GET['logout']) // if logout is true
		{ 
			// clear all current session variables
			session_unset();
			session_destroy();
			header ("location: ./"); // refreshes the index page
		}
	}
?>

<?php /*// if user is  logged in, show user dashboard
if(isset($_SESSION['user_id']) && isset($_SESSION['username'])):?>
	<p>Welcome, <?php echo $_SESSION['username']; ?>, to the Social Travel Guide! </p>
    
    <!-- Show a menu that allows user to log out -->
    <ul>
    	<li><a href="index.php?logout=true">Log out</a></li>
    </ul>

<?php else: // otherwise, show log in view
	// Check if previous login attempt was unsuccessful
	include "view/login_view.php";?>
    
<?php endif; */?>
    
</div>

<script>
function check_login() {
	alert("Login button has been clicked");	
}
</script>

<?php include("footer.php"); ?>






