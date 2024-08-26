<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Exercise List</h1>';



$db = connectToDB();

consolelog($db);
//Query which selects info from exercise table
$query = 'SELECT exercise.id     AS id,
                 exercise.name     AS ename,
                 exercise.sets      AS esets,
                 exercise.reps      AS ereps,
                 exercise.description AS edescription

                 FROM exercise

                 ORDER BY exercise.name ASC';
//Attemping to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $exercise = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting exercise data from the database');
}

//see what we get back
consoleLog($exercise);


//Table which list all the info shown in the exercise list page
echo '<table>
<tr>
    <th>Name</th>
    <th>Sets</th>
    <th>Reps</th>
    <th>Delete</th>
</tr>';

foreach($exercise as $exer) {
  echo '<tr>';
  echo '<td> <a href="exercise-description.php?id=' . $exer['id'] . '">' . $exer['ename'] . '</a>' ;
  echo '<td>' . $exer['esets'] . '</td>';
  echo '<td>' . $exer['ereps'] . '</td>';
  echo '<td> <a href="delete-exercise.php?id=' . $exer['id'] . '" onclick="return confirm(`Are you sure?`);">🗑️</a>';
  echo '</tr>';
}

echo '</table>';
//Button to add an exercise
echo '<div id="exercise-button">
<a href="form-exercise.php">
Add Exercise
</a>
</div>';
//Button to go to the workout page
echo '<div id="workout-button">
<a href="workout.php">
Workouts
</a>
</div>';



include 'partials/bottom.php'; ?>