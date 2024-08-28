<?php
require 'lib/utils.php';
include 'partials/top.php'; 
?>

<h2>New Exercise</h2>
<!-- Form ro add a new exercise to the exercise table -->
<form method="post" action="add-exercise.php">

    <label>Name</label>
    <input name ="name" type="text" placeholder="e.g Bench Press" required>

    <label>Description</label>
    <input name ="description" type="text" placeholder="e.g Banana's" required>

    <label>Sets</label>
    <input name ="sets" type="number" placeholder="e.g 3" required>

    <label>Reps</label>
    <input name ="reps" type="number" placeholder="e.g 10" required>

    <input type="submit" value="Add">

</form>
<!-- Button which takes the user back to the exercise list -->
<div id="form-button"> 
<a href="list-exercise.php">
Cancel
</a>

<?php include 'partials/bottom.php'; ?>