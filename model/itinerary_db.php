<?php
// This script handles all functionality for the user itineraries. 

require_once('database.php'); // connect to the database
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

if(isset($_POST['action']))
{
	switch($_POST['action'])
	{
		case "create_itinerary":
			if(isset($_SESSION['user_id']) 
			&& isset($_POST['i_name'])
			&& isset($_POST['i_desc'])
			&& isset($_POST['i_dest'])
			&& isset($_POST['start_date'])
			&& isset($_POST['end_date']))
			{
				create_itinerary(
					$_SESSION['user_id'],
					$_POST['i_name'],
					$_POST['i_desc'],
					$_POST['i_dest'],
					$_POST['start_date'],
					$_POST['end_date']
				);
			}
		break;	
	}
}

// Retrieves the current number of itineraries the user has
function get_itineraries($user_id)
{
	global $db;
    $query = 'SELECT * FROM itinerary
              WHERE user_id = :user_id'
			  ;
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
		//print_r($result);
		//echo("There are " . $statement->rowCount());
		// Push each id into the $_SESSION['itinerary_ids'] array
		//foreach($result as $row)
		//{
		//	array_push($_SESSION['itinerary_ids'], $row['itinerary_id']);	
		//}
		return $result;
		
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

/**
Inserts a new row in the itinerary table
	$user_id: 	current user's id
  	$i_name: 	itinerary name
	$i_desc: 	itinerary description
	$i_dest: 	destination
	$i_start: 	start date
	$i_end: 	end date
*/
function create_itinerary($user_id, $i_name, $i_desc, $i_dest, $i_start, $i_end)
{
	global $db;
	global $itinerary_ids;
	
    $query = 'INSERT INTO itinerary (
				itinerary_name,
				itinerary_desc,
				destination,
				start_date,
				end_date,
				user_id)
              VALUES (
			  	:i_name,
				:i_desc,
				:i_dest,
				:i_start,
				:i_end,
				:user_id)';
    try 
	{
        $statement = $db->prepare($query);
		$statement->bindValue(':i_name', $i_name);
		$statement->bindValue(':i_desc', $i_desc);
        $statement->bindValue(':i_dest', $i_dest);
		$statement->bindValue(':i_start', $i_start);
		$statement->bindValue(':i_end', $i_end);
		$statement->bindValue(':user_id', $user_id);
        $result = $statement->execute(); // returns true or false;
		// if successful, save the last insert id into the saved itineraries array
		if($result) 
		{
			//array_push($_SESSION['itinerary_ids'], $db->lastInsertId());
			// redirect back to user dashboard
			header("Location: ../");
		}
        $statement->closeCursor();
		
	} 
	catch (PDOException $e) 
	{
        display_db_error($e->getMessage());
    }		
}
?>
