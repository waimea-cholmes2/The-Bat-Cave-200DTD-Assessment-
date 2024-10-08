<?php
require 'lib/utils.php';
include 'partials/top.php'; 


$db = connectToDB();

// and the ID's from the URL
consoleLog($_GET, 'Get Data');
$workoutID = $_GET['id'] ?? null;

//Form to add info into date and time table
?>
<h2>Add Progress</h2>

<form method="post" action="add-progress.php?id=<?= $workoutID ?>">

    <label>Date</label>
    <input name="date" type="date" min="<?= date('Y-m-d') ?>" required>

    <label>Time</label>
    <input name ="time" type="time" required>

    <input type="submit" value="Add">

</form>
<!-- Button to go back to the workout progress page  -->
<div id="form-button"> 
<a href="workout_progress.php?id=<?= $workoutID ?>">
Cancel
</a>
</div>

<?php include 'partials/bottom.php'; ?>