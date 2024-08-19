<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Exercise List</h1>';


$workoutID = $_GET['id'] ?? null;
if($workoutID == null) die('Missing ID');

$db = connectToDB();


echo '<div id="back-button-workout">
<a href="workout.php">
Back
</a>
</div>';

consolelog($db);

$query = 'SELECT exercise.name  AS ename

            FROM contains
            JOIN exercise ON contains.exercise_id = exercise.id
            WHERE contains.workout_id = ?';

try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID]);
    $workouts = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB List Fetch', ERROR);
    die('There was an error getting service data from the database');
}
 

// See what we got back
consoleLog($workouts);
 
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
 
echo '<div id="modify-button">
<a href="modify.php?id='. $workoutID . '">
Modify
</a>
</div>';

$query = 'SELECT date_and_time.date    AS datd,
                 date_and_time.time     AS datt

                 FROM date_and_time WHERE workout = ?';

try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID]);
    $date_and_time = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting workout data from the database');
}

//see what we get back
consoleLog($date_and_time);

if($date_and_time == false) die('You have no progress on this workout, <a href="form-dat-progress.php?id='. $workoutID . '">Add</a>');

echo '<table>
<tr>
    <th>Date</th>
    <th>Time</th>
</tr>';

foreach($date_and_time as $dat) {
  echo '<tr>';
  echo '<td>' . $dat['datd'] . '</td>';
  echo '<td>' . $dat['datt'] . '</td>';
  echo '</tr>';
}

echo '</table>';

echo '<div id="progress-button">
<a href="form-dat-progress.php">
Add Progress
</a>
</div>';







include 'partials/bottom.php'; ?>