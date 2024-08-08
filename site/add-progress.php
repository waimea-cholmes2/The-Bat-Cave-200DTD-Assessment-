<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Adding Progress to data base</h1>';

consolelog($_POST, 'POST DATA');

//get form data
$date  = $_POST['date'];
$time   = $_POST['time'];
$workout     = $_POST['workout'];

echo '<p>date: ' . $date;
echo '<p>time: ' . $time;
echo '<p>workout: ' . $workout;




//connect to data base
$db = connectToDB();


//set up query to get all company info
$query = 'INSERT INTO date_and_time (date,time,workout) VALUES (?,?,?)';
//attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$date,$time,$workout]);
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error adding data to the database');
}

echo '<p>Success!</p>';


 include 'partials/bottom.php'; 
 ?>