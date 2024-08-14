<?php
require 'lib/utils.php';
include 'partials/top.php';
 
$exerciseID = $_GET['exercise_id'] ?? null;
$workoutID = $_GET['workout_id'] ?? null;
 
// SQL we need to get the company info...
// SELECT * FROM companies WHERE code = XXX
 
// Connect to the database
$db = connectToDB();
// Company------------------------------------------------------------------------
<<<<<<< HEAD
// Setup a query to get all company info
$query = 'DELETE FROM contains WHERE workout_id=? AND exercise_id=?';
=======
// Setup a query to delete info
$query = 'DELETE FROM contains WHERE workout_id AND exercise_id=?';
>>>>>>> c8a8d7288d9fcd524fb6d0bb92bbf88f5e120ee0

 
// Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID, $exerciseID]);  //Pass in the data
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB List Fetch', ERROR);
    die('There was an error removing exercise data from the workout database');
}
header('location: modify.php?id=' . $workoutID);