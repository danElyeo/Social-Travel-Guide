<?php
require_once('util/main.php');
require_once('util/tags.php');
require_once('model/database.php');

include("header.php"); 
?>
<!-- Depending on the state of the site, main content area will change -->
<div class="main_content_area">
    <p>Welcome to the Social Travel Guide, the site where you ask your friends and social network to suggest activities and plan your travel itinerary for you! </p>
    
    <div id="login_container">
        <p>To start off, login here to start viewing and planning for your trips!</p>
        <form action="" method="post" class="left_indent">
            <table>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" id="username"></td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td><input type="password" id="password"></td>
                </tr>
                <tr>
                    <td> </td>
                    <td><input type="submit" value="Login"></td>
                </tr>
            </table>
        </form>
    </div>
    
    <div>
        <p>Not a member? Click <a href="register.php">here</a> to register for free now!</p>
    </div>
</div>

<?php include("footer.php"); ?>






