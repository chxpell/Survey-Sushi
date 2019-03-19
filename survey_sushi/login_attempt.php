<?php include 'header.php'; ?>

<?php
$link = mysql_connect('dbsrv2.cs.fsu.edu','egonzale','F4u$2G&P-a') or die('Could not connect to server'.mysql_error());
                mysql_select_db('egonzaledb') or die('Could not select db');

$result = mysql_query("SELECT * FROM user_auth");
?>

<div class = "container-fluid" style = "margin-top:5rem;">

  <?php
  session_start();
$_SESSION['name'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];
?>

<?php
while($LOL = mysql_fetch_array($result))
{
if ($LOL['username'] == $_SESSION['name'] && $LOL['password'] == $_SESSION['password']){
    $_SESSION['status'] = "online";
    echo "<h1>",
    "Success!",
    "</h1>";
  }
else {
  echo "Login Failed";
}
}
mysql_close($link);
?>

</div>


<?php
mysql_close($link);
include 'footer.php';
?>
