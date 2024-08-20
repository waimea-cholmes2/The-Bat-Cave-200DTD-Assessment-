<?php
require 'lib/utils.php';
include 'partials/top.php'; 


$db = connectToDB();

// and the id from the ULR
consoleLog($_GET, 'Get Data');
$workoutID = $_GET['id'] ?? null;

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

?>
<h2>Add Progress</h2>

<form method="post" action="add-progress.php?id=<?= $workoutID ?>">

    <label>Date</label>
    <input name="date" type="date" min="<?= date('Y-m-d') ?>" required>

    <label>Time</label>
    <input name ="time" type="time" placeholder="e.g 10" required>

    <input type="submit" value="Add">

</form>

<a href="workout_progress.php?=<?= $workoutID ?>">
Cancel
</a>

<?php include 'partials/bottom.php'; ?>