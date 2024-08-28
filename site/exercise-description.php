<?php
require 'lib/utils.php';
include 'partials/top.php';

echo '<h2>Exercise Description</h2>';

$exerciseid = $_GET['id'] ?? null;
if($exerciseid == null) die('Missing ID');


$db = connectToDB();

consolelog($_GET);
// Set up a query to pull the exercise description from the database
$query = 'SELECT * FROM exercise WHERE id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$exerciseid]); //Pass in the data
    $exercise = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting exercise data from the database');
}


//see what we get back
consoleLog($exercise);
//Fail if the data was noy given properly
if($exercise == false) die('Exercise ID is invalid');

// Make a table for the exercise descriprion
echo '<table>
<tr>
    <th>Description</th>
</tr>';

  echo '<tr>';
  echo '<td>' . $exercise['description'] . '</td>';
  echo '</tr>';
  echo '</table>';

//Button to go back to exercise list
echo '<div id="form-button">
<a href="list-exercise.php">
Back
</a>
</div>';




include 'partials/bottom.php'; ?>