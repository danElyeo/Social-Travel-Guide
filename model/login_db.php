<?php
// This script handles the login functionality. First, it gets the username and password from the login box, then connects to the database to get the user_id from the user table. 

require_once('database.php');

if(isset($_POST['username']) && isset($_POST['password']))
{
	$username = $_POST['username'];	
	$password = $_POST['password'];
	
	// Store result set in $user_info
	$user_info = get_user_info($username, $password);
	//print_r($user_info);
	session_start();
	
	// if database checks out, set state to logged_in
	if(!empty($user_info))
	{
		$_SESSION['user_id'] = $user_info['user_id'];
		$_SESSION['username'] = $user_info['username'];
		//echo "Session userid: " . $_SESSION['user_id'];
		//echo "Session username: " . $_SESSION['username'];
		// Redirect user to the dashboard
		//$_SESSION['state'] = "logged_in";
		//header( 'Location: ../' ) ; // redirect back to index page
	}
	else // invalid username or password
	{
		//echo "invalid login!";
		$_SESSION['invalid_login'] = true;
		//header( 'Location: ../index.php?invalid_login=true' ) ;
		//$GLOBALS['action'] = "invalid_login";
		//header( 'Location: ../');
	}
	
	header( 'Location: ../' );
}

// Connect to the database to get the user_info from user table
function get_user_info($user, $pass) {
    global $db;
	
	$password = sha1($pass);
	
    $query = 'SELECT * FROM user
              WHERE username = :username
			  AND password = :password'
			  ;
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $user);
		$statement->bindValue(':password', $password);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
		
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

?>