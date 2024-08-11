<?php
require 'lib/utils.php';
include 'partials/top.php'; 
?>

<h2>Add Progress</h2>

<form method="post" action="add-progress.php">

    <label>Workout</label>
    <select name ="workout" required>

    <?php 
    foreach($exercises as $exercise){
        echo '<option value="'.$exercise['id'].'">';
        echo   $exercise['name'];
        echo '</option>';
    }
    ?>

    <label>Date</label>
    <input name="date" type="date" min="<?= date('Y-m-d') ?>" required>

    <label>Time</label>
    <input name ="time" type="time" placeholder="e.g 10" required>

    <input type="submit" value="Add">

</form>

<a href="workout-progress.php">
Cancel
</a>

<?php include 'partials/bottom.php'; ?>