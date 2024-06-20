<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1> Exercise List</h1>';



$db = connectToDB();

consolelog($db);

$query = 'SELECT exercise.name     AS ename,
                 exercise.description AS edescription,
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
    <th>Description</th>
    <th>sets</th>
    <th>reps</th>
</tr>';

foreach($exercise as $exer) {
  echo '<tr>';
  echo '<td> <a href="stats-exercise.php">' . $exer['ename'] . '</a>';
  echo '<td>' . $exer['edescription'] . '</td>';
  echo '<td>' . $exer['esets'] . '</td>';
  echo '<td>' . $exer['ereps'] . '</td>';
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