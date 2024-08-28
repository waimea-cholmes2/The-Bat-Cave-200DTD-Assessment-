<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Exercise List</h1>';

//Get ID's from the URL
$workoutID = $_GET['id'] ?? null;
if($workoutID == null) die('Missing ID');

$db = connectToDB();

//Button to go back to the workout page
echo '<div id="back-button-workout">
<a href="workout.php">
Back
</a>
</div>';

consolelog($db);
//Set up a query to select all exercises in the current workout
$query = 'SELECT exercise.name  AS ename

            FROM contains
            JOIN exercise ON contains.exercise_id = exercise.id
            WHERE contains.workout_id = ?';
//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID]);//Pass in data
    $workouts = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB List Fetch', ERROR);
    die('There was an error getting service data from the database');
}
 

// See what we got back
consoleLog($workouts);
 //List all exercises in the current workout
echo '<ul id="name-list">';
 
echo '<table>
        <tr>
            <th>Name</th>
        </tr>';
 
foreach($workouts as $work) {
    echo '<tr>';
    echo '<td>' . $work['ename'] . '</td>';
 
    echo '</tr>';
}
 
echo '</table>';
 
echo '</ul>';
 //Button to go to the nodify page
echo '<div id="modify-button">
<a href="modify.php?id='. $workoutID . '">
Modify
</a>
</div>';
//Set up a query to select info from the date and time table
$query = 'SELECT date_and_time.id      AS id,
                 date_and_time.date    AS datd,
                 date_and_time.time    AS datt

                 FROM date_and_time WHERE workout = ?';
//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID]);//Pass in data
    $date_and_time = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting workout data from the database');
}

//see what we get back
consoleLog($date_and_time);
//Set up a table top show all date and time info in the current exercise
if($date_and_time == false) die('You have no progress on this workout <div id="form-button"> <a href="form-dat-progress.php?id='. $workoutID . '">Add</a>');
echo '<table>
<tr>
    <th>Date</th>
    <th>Time</th>
    <th>Delete Progress</th>
</tr>';

foreach($date_and_time as $dat) {
  echo '<tr>';
  echo '<td>' . $dat['datd'] . '</td>';
  echo '<td>' . $dat['datt'] . '</td>';
  echo '<td> <a href="delete-progress.php?id=' . $dat['id'] .  ' &wid= ' . $workoutID . ' " onclick="return confirm(`Are you sure?`);">🗑️</a>';
  echo '</tr>';
}
echo '</table>';
//Button to take the user to the add progress form
echo '<div id="progress-button">
<a href="form-dat-progress.php?id='. $workoutID . '">
Add Progress
</a>
</div>';







include 'partials/bottom.php'; ?>