<?php
require 'lib/utils.php';
include 'partials/top.php'; 
?>

<h3><?= SITE_LOGO ?></h3>
<?=//Button to go to exercise list?>
<div id="exercise-button">
<a href="list-exercise.php">
Exercise List
</a>
</div>
<?=//Button to go to workout page?>
<div id="workout-button">
<a href="workout.php">
Workouts
</a>
</div>

<?php include 'partials/bottom.php'; ?>


