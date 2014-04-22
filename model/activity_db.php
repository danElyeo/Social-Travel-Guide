<?php
// This script handles all functionality for the activiites. 

require_once('database.php'); // connect to the database
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

if(isset($_POST['action']))
{
	switch($_POST['action'])
	{
		case "create_activity":
			if(isset($_POST['itinerary_id']) 
			&& isset($_POST['a_name']))
			//&& isset($_POST['a_desc'])
			//&& isset($_POST['days'])
			//&& isset($_POST['hrs'])
			//&& isset($_POST['mins'])
			//&& isset($_POST['a_type'])
			//&& isset($_POST['a_address1'])
			//&& isset($_POST['a_address2'])
			//&& isset($_POST['a_address3']))
			{
				create_activity(
					$_POST['itinerary_id'],
					$_SESSION['username'], // author
					$_POST['a_name'],
					$_POST['a_desc'],
					$_POST['days'],
					$_POST['hours'],
					$_POST['mins'],
					$_POST['a_type'],
					$_POST['a_address1'],
					$_POST['a_address2'],
					$_POST['a_address3']
				);
			}
		break;	
	}
}

// Get all activities for the current itinerary
function get_activities($itinerary_id)
{
	global $db;
    $query = 'SELECT * FROM activity
              WHERE itinerary_id = :itinerary_id'
			  ;
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':itinerary_id', $itinerary_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
	
		return $result;
		
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

// Inserts new activity data in the db
function create_activity(
	$itinerary_id,
	$author,
	$a_name,
	$a_desc,
	$duration_days,
	$duration_hours,
	$duration_mins,
	$a_type,
	$address1,
	$address2,
	$address3
){
	global $db;
	
    $query = 'INSERT INTO activity (
				itinerary_id,
				activity_name,
				activity_desc,
				author,
				duration_days,
				duration_hrs,
				duration_mins,
				activity_type,
				activity_addr1,
				activity_addr2,
				activity_addr3
				)
              VALUES (
			  	:i_id,
				:a_name,
				:a_desc,
				:a_author,
				:a_dur_days,
				:a_dur_hrs,
				:a_dur_mins,
				:a_type,
				:a_addr1,
				:a_addr2,
				:a_addr3
				)';
    try 
	{
        $statement = $db->prepare($query);
		$statement->bindValue(':i_id', $itinerary_id);
		$statement->bindValue(':a_name', $a_name);
		$statement->bindValue(':a_desc', $a_desc);
        $statement->bindValue(':a_author', $author);
		$statement->bindValue(':a_dur_days', $duration_days);
		$statement->bindValue(':a_dur_hrs', $duration_hours);
		$statement->bindValue(':a_dur_mins', $duration_mins);
		$statement->bindValue(':a_type', $a_type);
		$statement->bindValue(':a_addr1', $address1);
		$statement->bindValue(':a_addr2', $address2);
		$statement->bindValue(':a_addr3', $address3);
        $result = $statement->execute(); // returns true or false;
		// if successful, save the last insert id into the saved itineraries array
		if($result) 
		{
			//array_push($_SESSION['itinerary_ids'], $db->lastInsertId());
			// redirect back to itinerary details page
			header("Location: ../view/itinerary_details.php");
		}
        $statement->closeCursor();
		
	} 
	catch (PDOException $e) 
	{
        display_db_error($e->getMessage());
    }		
}
