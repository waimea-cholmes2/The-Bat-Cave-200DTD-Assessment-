<?php
require 'lib/utils.php';
include 'partials/top.php';
 
// Get ID from URL
$workoutID = $_GET['id'] ?? '';
 
 
// Connect to the database
$db = connectToDB();
// Setup a query to delete info from workout table
$query = 'DELETE FROM workouts WHERE id=?';

 
// Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID]);  //Pass in the data
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB List Fetch', ERROR);
    die('Please remove all exercises from the workout in the modify page before you delete the workout. <a href="workout.php">Back</a>');
}
header('location: workout.php');