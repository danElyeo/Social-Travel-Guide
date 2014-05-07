<?php
// This script handles all functionality for the activiites. 
//print_r($_POST);
require_once('database.php'); // connect to the database
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

if(isset($_POST['action']))
{
	//echo "Action is " . $_POST['action'];
	switch($_POST['action'])
	{
		case "create_activity":
			if(isset($_SESSION['current_itinerary']) 
			&& isset($_POST['a_name']))
			{
				create_activity(
					$_SESSION['current_itinerary'],
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
		
		// same as create_activity except this is added by friends
		case "add_suggestion": 
			echo $_POST['i_id'].", ".
					$_POST['author'].", ". // author
					$_POST['a_name'].", ".
					$_POST['a_desc'].", ".
					$_POST['days'].", ".
					$_POST['hours'].", ".
					$_POST['mins'].", ".
					$_POST['a_type'].", ".
					$_POST['a_address1'].", ".
					$_POST['a_address2'].", ".
					$_POST['a_address3'];
			if(isset($_POST['i_id']) && isset($_POST['author']))
			{
				create_activity(
					$_POST['i_id'],
					$_POST['author'], // author
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
		
		case "update_activity":
			if (isset($_POST['a_id']))
			{
				//echo "Updating activity id: " . $_POST['a_id'];
				update_activity(
					$_POST['a_id'],
					//$_SESSION['current_itinerary'],
					//$_SESSION['username'], // author
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
		
		case "delete_activity":
			//echo "Deleting activity id: ";
			if (isset($_POST['a_id']))
			{
				//echo "Deleting activity id: " . $_POST['a_id'];
				delete_activity($_POST['a_id']);
			}
		break;
		
		case "add_to_schedule":
			if (isset($_POST['a_id']))
			{
				add_to_schedule($_POST['a_id']);
			}
		break;
		
		case "remove_from_schedule":
			if (isset($_POST['a_id']))
			{
				remove_from_schedule($_POST['a_id']);
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
			if(isset($_SESSION['user_id']))
			{
				// came from user
				header("Location: ../view/itinerary_details.php");
			}
			else
			{
				// came from friend
				header("Location: ../friend/view_itinerary.php?i_id=".$itinerary_id);	
			}
			
		}
        $statement->closeCursor();
		
	} 
	catch (PDOException $e) 
	{
        display_db_error($e->getMessage());
    }		
}

function update_activity(
	$a_id,
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
    $query = 'UPDATE activity
				SET activity_name = :a_name,
					activity_desc = :a_desc,
					duration_days = :a_dur_days,
					duration_hrs  = :a_dur_hrs,
					duration_mins = :a_dur_mins,
					activity_type = :a_type,
					activity_addr1 = :a_addr1,
					activity_addr2 = :a_addr2,
					activity_addr3 = :a_addr3
				WHERE activity_id = :a_id';
	try {
        $statement = $db->prepare($query);
        $statement->bindValue(':a_id', $a_id);
        $statement->bindValue(':a_name', $a_name);
        $statement->bindValue(':a_desc', $a_desc);
        $statement->bindValue(':a_dur_days', $duration_days);
		$statement->bindValue(':a_dur_hrs', $duration_hours);
		$statement->bindValue(':a_dur_mins', $duration_mins);
		$statement->bindValue(':a_type', $a_type);
        $statement->bindValue(':a_addr1', $address1);
		$statement->bindValue(':a_addr2', $address2);
		$statement->bindValue(':a_addr3', $address3);
        
        $row_count = $statement->execute();
        $statement->closeCursor();
        //return $row_count;
		// If update is successful, return to itinerary details page
		if($row_count)
		{
			header("Location: ../view/itinerary_details.php");
		}
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_activity($a_id)
{
	global $db;
    $query = 'DELETE FROM activity WHERE activity_id = :a_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':a_id', $a_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
		//return $row_count;
        echo $row_count; // returns to ajax call from itinerary_details.php
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }	
}

function add_to_schedule($a_id)
{
	global $db;
	$query = 'UPDATE activity
				SET in_schedule = :in_schedule
				WHERE activity_id = :a_id';
	try {
        $statement = $db->prepare($query);
        $statement->bindValue(':a_id', $a_id);
        $statement->bindValue(':in_schedule', "1");
   		
        $row_count = $statement->execute();
        $statement->closeCursor();
		echo $row_count;
        //if($row_count)
		//{
		//	header("Location: ../view/itinerary_details.php");
		//}
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function remove_from_schedule($a_id)
{
	global $db;
	$query = 'UPDATE activity
				SET in_schedule = :in_schedule
				WHERE activity_id = :a_id';
	try {
        $statement = $db->prepare($query);
        $statement->bindValue(':a_id', $a_id);
        $statement->bindValue(':in_schedule', "0");
   		
        $row_count = $statement->execute();
        $statement->closeCursor();
        echo $row_count;
		//if($row_count)
		//{
		//	header("Location: ../view/itinerary_details.php");
		//}
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
			