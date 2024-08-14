<?php
require 'lib/utils.php';
include 'partials/top.php';

echo '<h2>Exercise Description</h2>';

$exerciseid = $_GET['id'] ?? null;
if($exerciseid == null) die('Missing ID');


$db = connectToDB();

consolelog($_GET);

$query = 'SELECT * FROM exercise WHERE id = ?';

// $query = 'SELECT exercise.description    AS edescription

//                 FROM exercise WHERE name = ?

try {
    $stmt = $db->prepare($query);
    $stmt->execute([$exerciseid]);
    $exercise = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting exercise data from the database');
}


//see what we get back
consoleLog($exercise);

if($exercise == false) die('Exercise ID is invalid');

echo '<table>
<tr>
    <th>Description</th>
    <th></th>
</tr>';

  echo '<tr>';
  echo '<td>' . $exercise['description'] . '</td>';
  echo '</tr>';
  echo '</table>';

echo '<div id="button">
<a href="list-exercise.php">
Back
</a>
</div>';




include 'partials/bottom.php'; ?>