<?php
require 'lib/utils.php';
include 'partials/top.php';
 
$workoutID = $_GET['id'] ?? '';
 
// SQL we need to get the company info...
// SELECT * FROM companies WHERE code = XXX
 
// Connect to the database
$db = connectToDB();
// Company------------------------------------------------------------------------
// Setup a query to get all company info
$query = 'DELETE FROM workouts WHERE id=?';

 
// Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID]);  //Pass in the data
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB List Fetch', ERROR);
    die('There was an error updating workout data from the database');
}
header('location: workout.php');