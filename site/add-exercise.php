<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Adding Exercise to data base</h1>';

consolelog($_POST, 'POST DATA');

//get form data
$name   = $_POST['name'];
$description   = $_POST['description'];
$sets     = $_POST['sets'];
$reps     = $_POST['reps'];

//Print all of the data that has been submitted into the form
echo '<p>name: ' . $name;
echo '<p>description: ' . $description;
echo '<p>sets: ' . $sets;
echo '<p>reps: ' . $reps;



//connect to data base
$db = connectToDB();


//set up query to insert all new exercise info into the exercise table
$query = 'INSERT INTO exercise (name, description, sets, reps) VALUES (?,?,?,?)';
//attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([ $name, $description, $sets, $reps]);
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error adding data to the database');
}

echo '<p>Success!</p>';

//Button to go back to exercise list
echo '<a href="list-exercise.php">
Back
</a>';

 include 'partials/bottom.php'; 
 ?>