<?php
require 'lib/utils.php';
include 'partials/top.php';
 
echo '<h1>Adding exercise to workout database</h1>';

//Get form data 
consoleLog($_POST, 'POST DATA');
$exerciseID  = $_POST['exercise'];

// and the id from the ULR
consoleLog($_GET, 'Get Data');
$workoutID = $_GET['id'] ?? null;

 
//Connect to the database
$db = connectToDB();
 
 //Set up a query to insert into the contains table
$query = 'INSERT INTO contains (workout_id, exercise_id) VALUES (?, ?)';

//Attempt to run the query 
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID, $exerciseID]); // pass in data
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB Booking Add', ERROR);
    die(' There was an error adding exercise data to the workout database');
}
 
//Go back to the form
header('location: modify.php?id=' . $workoutID);
 
include 'partials/bottom.php'; ?>
 
 