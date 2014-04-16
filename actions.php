<?php
require_once('util/main.php');

if(isset($_POST['change_state']))
{
	switch($_POST['change_state'])
	{
		case "new_itinerary":
			$_SESSION['state'] = "new_itinerary";
		break;
		
		case "user_dashboard":
			$_SESSION['state'] = "user_dashboard";
		break;	
	}
}

if(isset($_POST['action']))
{
	switch($_POST['action'])
	{
		case "logout":
			// clear all session variables
			session_unset();
			session_destroy();
		break;	
	}
}
?>