<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Exercise List</h1>';


$workoutID = $_GET['id'] ?? null;
if($workoutID == null) die('Missing ID');

$db = connectToDB();




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



$query = 'SELECT * FROM exercise';
//attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $exercises = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}
?>

<form method="post" action="add-exer-work.php?id=<?= $workoutID ?>" >

<label>Exercises</label>
    <select name ="exercises" required>

<?php 
foreach($exercises as $exercise){
    echo '<option value="'.$exercise['id'].'">';
    echo   $exercise['name'];
    echo '</option>';
}
?>

<input type="submit" value="Add">

</form>

<?php
echo '<div id="modify-button">
<a href="workout_progress.php?id='. $workoutID . '">
Done
</a>
</div>';
?>