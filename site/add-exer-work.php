<?php
require 'lib/utils.php';
include 'partials/top.php';
 
echo '<h1>Adding booking to database</h1>';
 
consoleLog($_GET, 'Get Data');
 
//Get form data
$workoutID = $_GET['workout'] ?? null;
$exerciseID = $_GET['exercise'] ?? null;
 
//Connect to the database
$db = connectToDB();
 
 
$query = 'INSERT INTO contains (workout_id, exercise_id) VALUES (?, ?)';
//Attempt to run the query
 
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID, $exerciseID]);
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB Booking Add', ERROR);
    die(' There was an error adding exercise data to the workout database');
}
 
 header('location: modify.php');
 
include 'partials/bottom.php'; ?>
 
 