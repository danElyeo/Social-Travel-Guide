<?php
// This script handles the registration functionality. It retrieves all the user information from the registration page and insert a new row into the database user table. 

require_once('database.php'); // connect to the database

// Initializing variables
$email_unique = false;
$username_unique = false;

// Check if all the fields have values
if( isset($_POST['first_name']) && 
	isset($_POST['last_name']) && 
	isset($_POST['username']) && 
	isset($_POST['password']) &&
	isset($_POST['r_password']) &&
	isset($_POST['email']))
{
	// TODO: use JavaScript to check if password and r_password are the same before proceeding!
	// TODO: prevent user from registering if username already exist!	
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$r_password = $_POST['r_password'];
	$email = $_POST['email'];
	
	if($password === $r_password) // passwords match
	{
		// Check if username already exist
		check_username($username);
		check_email($email);
		if($username_unique && $email_unique)
		{
			echo "Username and email are unique. Proceed to register";	
		}
		else
		{
			if(!$username_unique)
			{
				echo "Username already exists. Try another!";	
			}
			if(!$email_unique)
			{
				echo "Email already exists. Try another!";	
			}
			
		}	
		//print_r("Checking if username exists: " . check_username($username));
		//print_r($temp['username']);
		//register_user($first_name, $last_name, $username, $password, $email);	
	}
	else
	{
		echo "Passwords are not matching!!!!";	
	}
}

function check_username($_username)
{
	global $db;
	global $username_unique;
    $query = 'SELECT username FROM user
              WHERE username = :username'
			  ;
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $_username);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
		if(!$result)
		{
			//echo "username is unique. Proceed to register";
			$username_unique = true;
		}
		
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function check_email($_email)
{
	global $db;
	global $email_unique;
    $query = 'SELECT email FROM user
              WHERE email = :email'
			  ;
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $_email);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
		if(!$result)
		{
			//echo "email is unique. Proceed to register";
			$email_unique = true;
		}
		
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function register_user($first, $last, $user, $pass, $email)
{
	global $db;
    $query = 'INSERT INTO user (
				first_name,
				last_name,
				username,
				password,
				email)
              VALUES (
			  	:first_name,
				:last_name,
				:username,
				:password,
				:email)';
    try {
        $statement = $db->prepare($query);
		$statement->bindValue(':first_name', $first);
		$statement->bindValue(':last_name', $last);
        $statement->bindValue(':username', $user);
		$statement->bindValue(':password', $pass);
		$statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch(); // returns true or false;
        $statement->closeCursor();
        
		if($result) {
			echo "Registration successful!";		
		} 
		else
		{
			echo "Registration failed!";		
		}
		
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }	
}	
?>