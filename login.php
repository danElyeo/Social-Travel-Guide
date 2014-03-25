<?php
// This script handles the login functionality. First, it gets the username and password from the login box, then connects to the database to get the user_id from the user table. 

require_once('util/main.php');
require_once('model/database.php');
 
if(isset($_POST['username']))
{
	$username = $_POST['username'];	
}

if(isset($_POST['password']))
{
	$password = $_POST['password'];	
}


//print($user_info['user_id']);
$user_info = get_user_info($username, $password);
$_SESSION['user_id'] = $user_info['user_id'];
$_SESSION['username'] = $user_info['username'];

header( 'Location: http://localhost/cs601/Project/' ) ; // redirect back to index page


// Connect to the database to get the user_id
function get_user_info($user, $pass) {
    global $db;
    $query = 'SELECT * FROM user
              WHERE username = :username
			  AND password = :password'
			  ;
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $user);
		$statement->bindValue(':password', $pass);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
		//$user_id = $result['user_id'];
		//return $user_id;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

?>