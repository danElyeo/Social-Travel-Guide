<p>Welcome to the Social Travel Guide, the site where you ask your friends and social network to suggest activities and plan your travel itinerary for you! </p>
    
    <div id="login_container">
        <p>To start off, login here to start viewing and planning for your trips!</p>
        
        <?php 
			if($_SESSION['state'] == "invalid_login")
			{
				echo "<div class='error'>*Invalid username and/or password! Please try again.</div>";		
			}
		?>
        <form action="model/login_db.php" method="post" class="left_indent">
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
        <p>Not a member? Click <a href="view/register_view.php">here</a> to register for free now!</p>
    </div>
    
    <script>
	function open_registration_form() {
		<?php 
			$_SESSION['state'] = "register_user";
			//header ("Location: ./");
			echo "Hello World!";
		?>	
		//window.location.href = "./";
	}
	</script>