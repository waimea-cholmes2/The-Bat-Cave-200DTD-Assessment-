<?php
require 'lib/utils.php';
include 'partials/top.php';
 
// Get the id's from the URL
$progressID = $_GET['id'] ?? '';
$workoutID = $_GET['wid'] ?? null;
 
// Connect to the database
$db = connectToDB();

// Setup a query to delete some date and time info
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

echo '</main>';
// Go back to page with info
header('location: workout_progress.php?id=' . $workoutID);