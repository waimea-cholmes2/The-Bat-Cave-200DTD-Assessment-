<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Adding Workout to data base</h1>';

consolelog($_POST, 'POST DATA');

//get form data
$name   = $_POST['name'];

echo '<p>name: ' . $name;



//connect to data base
$db = connectToDB();


//set up query to get all companny info
$query = 'INSERT INTO workouts (name) VALUES (?)';
//attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([ $name ]); // pass in data
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error adding data to the database');
}

echo '<p>Success!</p>';

//button to go back
echo '<div id="form-button">
<a href="workout.php">
Back
</a>
</div>';

 include 'partials/bottom.php'; 
 ?>