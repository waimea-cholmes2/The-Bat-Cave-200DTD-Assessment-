<?php
require 'lib/utils.php';
include 'partials/top.php';

echo '<h2>Exercise Description</h2>';



$db = connectToDB();

consolelog($db);

$query = 'SELECT exercise.description    AS edescription

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
    <th>Description</th>
    <th></th>
</tr>';

foreach($exercise as $exer) {
  echo '<tr>';
  echo '<td>' . $exer['edescription'] . '</td>';
  echo '</tr>';
}
  echo '</table>';

echo '<div id="button">
<a href="list-exercise.php">
Back
</a>
</div>';




include 'partials/bottom.php'; ?>