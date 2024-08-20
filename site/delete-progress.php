<?php
require 'lib/utils.php';
include 'partials/top.php';
 
$progressID = $_GET['id'] ?? '';
$workoutID = $_GET['workoutid'] ?? null;
 
// SQL we need to get the company info...
// SELECT * FROM companies WHERE code = XXX
 
// Connect to the database
$db = connectToDB();
// Company------------------------------------------------------------------------
// Setup a query to get all company info
$query = 'DELETE FROM date_and_time WHERE id=?';

 
// Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$progressID]);  //Pass in the data
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB List Fetch', ERROR);
    die('There was an error removing Progress');
}
// header('location: workout_progress.php?id=' . $workoutID);