<?php
require_once('util/main.php'); // starts the session
require_once('util/tags.php');
require_once('model/database.php');

include("view/header.php"); 

// debug
//echo "Current username is: " . $_SESSION['username'] . "<br/>";
//echo "Current user_id is: " . $_SESSION['user_id'] . "<br/>";

// If the user has previously logged out, clear session and reload
/*if(isset($_GET['logout']) && $_GET['logout'])
{
	session_unset();
	session_destroy();
	header("Location:./"); // refresh the page
}*/

?>
<!-- Depending on the state of the site, main content area will change -->
<div class="main_content_area">
<?php
// If user is logged in, show the dashboard, otherwise show the login view.
if(isset($_SESSION['user_id']) && isset($_SESSION['username'])) 
{
	// Show the user dashboard
	include("view/dashboard_view.php");
	
	// If there is no session state, create one and set to login
	//if(!isset($_SESSION['state']))
	//{
		//$_SESSION['state'] = "user_dashboard"; // default state	
	//}
	
	// Debug
	//echo "Current state: " . $_SESSION['state']; 
		
	//While the user is logged in, there may be many different views/states. Parse through the session state to determine which view to render to the user.
	/*switch($_SESSION['state'])
	{	
		case "user_dashboard":
			include("view/dashboard_view.php");
		break;
		
		// Show create itinerary form
		case "new_itinerary":
			include("view/new_itinerary.php");
		break;
		
		default:
			include("view/dashboard_view.php");
		break;	
	}*/
}
else // user is not logged in; show only the login view
{
	include("view/login_view.php");
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

<?php include("view/footer.php"); ?>






