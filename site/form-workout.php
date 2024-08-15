<?php
require 'lib/utils.php';
include 'partials/top.php'; 
?>

<h2>New Workout</h2>

<form method="post" action="add-workout.php">

    <label>Name</label>
    <input name ="name" type="text" placeholder="e.g Chest" required>

    <input type="submit" value="Add">

</form>

<a href="workout.php">
Cancel
</a>

<?php include 'partials/bottom.php'; ?>