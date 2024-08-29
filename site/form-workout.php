<?php
require 'lib/utils.php';
include 'partials/top.php'; 
?>
<!-- Form to insert data into workout table -->
<h2>New Workout</h2>

<form method="post" action="add-workout.php">

    <label>Name</label>
    <input name ="name" type="text" placeholder="e.g Chest" required>

    <input type="submit" value="Add">

</form>
<!-- Button to go back to workout page -->
<div id="form-button"> 
<a href="workout.php">
Cancel
</a>
</div>

<?php include 'partials/bottom.php'; ?>