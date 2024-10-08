<?php
require 'lib/utils.php';
include 'partials/top.php';
 
// Get ID's from the URL
$exerciseID = $_GET['exercise_id'] ?? null;
$workoutID = $_GET['workout_id'] ?? null;
 
 
// Connect to the database
$db = connectToDB();
// Company------------------------------------------------------------------------
// Setup a query to delete info from contains table
$query = 'DELETE FROM contains WHERE workout_id=? AND exercise_id=?';

 
// Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID, $exerciseID]);  //Pass in the data
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB List Fetch', ERROR);
    die('There was an error removing exercise data from the workout database');
}
// Go back to workout modify page
header('location: modify.php?id=' . $workoutID);