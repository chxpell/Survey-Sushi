<?php include 'header.php'; ?>

<?php
$link = mysql_connect('dbsrv2.cs.fsu.edu','egonzale','F4u$2G&P-a') or die('Could not connect to server'.mysql_error());
                mysql_select_db('egonzaledb') or die('Could not select db');

$result = mysql_query("SELECT * FROM user_auth");
?>

<div class = "container-fluid" style = "margin-top:5rem;">

  <?php
$name = $_POST['username'];
$password = $_POST['password'];
?>

<?php
while($LOL = mysql_fetch_array($result))
{
if ($LOL['username'] == $name && $LOL['password'] == $password){
    echo "Success!";
    echo '<script type="text/javascript">',
     'LoggedIn("',
     $name,
     '");',
     '</script>';
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
