<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Adding Progress to data base</h1>';

consolelog($_POST, 'POST DATA');

//get form data
$date  = $_POST['date'];
$time   = $_POST['time'];

// and the id from the ULR
consoleLog($_GET, 'Get Data');
$workoutID = $_GET['id'] ?? null;

//Print all of the data that has been submitted into the form
echo '<p>date: ' . $date;
echo '<p>time: ' . $time;
echo '<p>workout: ' . $workoutID;




//connect to data base
$db = connectToDB();

//set up query to insert all info into database
$query = 'INSERT INTO date_and_time (date,time,workout) VALUES (?,?,?)';
//attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$date,$time,$workoutID]); //pass in the data
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error adding data to the database');
}

echo '<p>Success!</p>';
//Go back to workout progress page
header('location: workout_progress.php?id=' . $workoutID);

 include 'partials/bottom.php'; 
 ?>