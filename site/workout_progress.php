<?php
require 'lib/utils.php';
include 'partials/top.php'; 

echo '<h1>Exercise List</h1>';



$db = connectToDB();


echo '<div id="add-button">
<a href="form-workout.php">
Add Workout
</a>
</div>';

consolelog($db);

$query = 'SELECT date_and_time.date    AS datd,
                 date_and_time.time     AS datt

                 FROM date_and_time WHERE id = ?';

try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $date_and_time = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting exercise data from the database');
}

//see what we get back
consoleLog($date_and_time);



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

echo '<div id="add-button">
<a href="form-exercise.php">
Add Exercise
</a>
</div>';





include 'partials/bottom.php'; ?>