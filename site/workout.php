<?php
require 'lib/utils.php';
include 'partials/top.php'; 
?>

<h1>Workouts</h1>

<?php

$db = connectToDB();

consolelog($db);
//set up query to get all companny info
$query = 'SELECT * FROM workouts';
//attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $workouts = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

//see what we get back
consoleLog($workouts);



echo '<ul id="workout-list">';

foreach($workouts as $work) {
    echo '<li>';
    echo '<a href="workout_progress.php?id=' . $work['id'] . '">' . $work['name'] . '</a>' ;
    echo '<td> <a href="delete-workout.php?id=' . $work['id'] . '" onclick="return confirm(`Are you sure?`);">🗑️</a>';

    echo '</li>';
}

echo '</ul>';

echo '<div id="add-button">
<a href="form-workout.php">
Add
</a>
</div>';

 include 'partials/bottom.php'; ?>