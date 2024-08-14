<?php
require 'lib/utils.php';
include 'partials/top.php';
//Get info from URL 
$workoutID = $_GET['id'] ?? '';
 
 
// Connect to the database
$db = connectToDB();
// Setup a query to delete info from the workout table
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