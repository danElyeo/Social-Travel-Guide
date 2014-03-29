<?php // if user is  logged in, show user dashboard
if(isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>

	<p>Welcome, <?php echo $_SESSION['username']; ?>, to the Social Travel Guide! </p>
    
    <!-- Show a menu that allows user to log out -->
    <ul>
    	<li><a href="index.php?logout=true">Log out</a></li>
    </ul>

<?php else: // otherwise, show log in view
	// Check if previous login attempt was unsuccessful
	include "view/login_view.php";?>
    
<?php endif; ?>