<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1> Exercise List</h1>';



$db = connectToDB();

consolelog($db);

$query = 'SELECT exercise.id     AS id,
                 exercise.name     AS ename,
                 exercise.sets      AS esets,
                 exercise.reps      AS ereps

                 FROM exercise

                 ORDER BY exercise.name ASC';

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



echo '<table>
<tr>
    <th>Name</th>
    <th>sets</th>
    <th>reps</th>
    <th></th>
</tr>';

foreach($exercise as $exer) {
  echo '<tr>';
  echo '<td> <a href="exercise-description.php">' . $exer['ename'] . '</a>' ;
  echo '<td>' . $exer['esets'] . '</td>';
  echo '<td>' . $exer['ereps'] . '</td>';
  echo '<td> <a href="delete-exercise.php?id=' . $exer['id'] . '" onclick="return confirm(`Are you sure?`);">🗑️</a>';
  echo '</tr>';
}

echo '</table>';

echo '<div id="add-button">
<a href="form-exercise.php">
Add Exercise
</a>
</div>';

echo '<div id="add-button">
<a href="form-workout.php">
Add Workout
</a>
</div>';



include 'partials/bottom.php'; ?>