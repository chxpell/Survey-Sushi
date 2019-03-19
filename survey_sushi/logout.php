<?php include 'header.php'; ?>

<?php
session_start();
$_SESSION['status'] = "offline";
?>

<div class = "container-fluid">

<h1>
You Are Now Logged Out
</h1>


</div>



<?php include 'footer.php';?>
