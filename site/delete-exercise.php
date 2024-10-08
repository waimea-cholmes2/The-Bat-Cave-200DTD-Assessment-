<?php
require 'lib/utils.php';
include 'partials/top.php';
 
$exerciseId = $_GET['id'] ?? '';
 
// SQL we need to get the company info...
// SELECT * FROM companies WHERE code = XXX
 
// Connect to the database
$db = connectToDB();
// Company------------------------------------------------------------------------
// Setup a query to delete info from exercise table
$query = 'DELETE FROM exercise WHERE id=?';

 
// Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$exerciseId]);  //Pass in the data
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB List Fetch', ERROR);
    die('There was an error updating exercise data from the database');
}

echo '</main>';
// Go back to exercise list
header('location: list-exercise.php');