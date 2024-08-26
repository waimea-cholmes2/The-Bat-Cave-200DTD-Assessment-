<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Exercise List</h1>';


$workoutID = $_GET['id'] ?? null;
if($workoutID == null) die('Missing ID');

$db = connectToDB();




consolelog($db);
//Query which gets info from the exercise & contains table
$query = 'SELECT exercise.name  AS ename,
                 exercise.id     AS eid

            FROM contains
            JOIN exercise ON contains.exercise_id = exercise.id
            WHERE contains.workout_id = ?';
//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID]);//pass in data
    $workouts = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getmessage(), 'DB List Fetch', ERROR);
    die('There was an error getting service data from the database');
}
 
// See what we got back
consoleLog($workouts);
 //List  all exercises in  the workout
echo '<ul id="name-list">';
 
echo '<table>
        <tr>
            <th>Name</th>
            <th>Remove</th>
        </tr>';
 
foreach($workouts as $work) {
    echo '<tr>';
    echo '<td>' . $work['ename'] . '</td>';
    echo '<td> <a href="delete-contains.php?workout_id=' . $workoutID . '&exercise_id=' . $work['eid'] . '" onclick="return confirm(`Are you sure?`);">🗑️</a>';

 
    echo '</tr>';
}
 
echo '</table>';
 
echo '</ul>';


//Set up a query which selects all exercises which are not on the current workout
$query = 'SELECT exercise.id   AS eid,
exercise.name AS ename

FROM exercise
CROSS JOIN workouts
LEFT JOIN contains ON contains.exercise_id = exercise.id 
           AND contains.workout_id   = workouts.id

WHERE contains.exercise_id IS NULL 
AND workouts.id = ?';
//attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$workoutID]);//Pass in data
    $exercises = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}
//Form to add exercises into workouts
?>

<form method="post" action="add-exer-work.php?id=<?= $workoutID ?>" >

<label>Exercises</label>
    <select name ="exercise" required>

<?php 
foreach($exercises as $exercise){
    echo '<option value="'.$exercise['eid'].'">';
    echo   $exercise['ename'];
    echo '</option>';
}
?>

<input type="submit" value="Add">

</form>

<?php
//Button to exit the modify page and go back to the progress page
echo '<div id="modify-button">
<a href="workout_progress.php?id='. $workoutID . '">
Done
</a>
</div>';
?>