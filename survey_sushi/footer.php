<!-- Bootstrap core JavaScript
================================================== -->

<?php
session_start();
$name = $_SESSION['name'];
$online = $_SESSION['status'];
if ($online == "online"){
  echo '<script type="text/javascript">',
   'LoggedIn("',
   $name,
   '");',
   '</script>';
}
?>

<!-- Placed at the end of the document so the pages load faster -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
</body>
</html>
