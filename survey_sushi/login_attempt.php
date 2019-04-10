<?php include 'header.php'; ?>

<?php
$link = mysql_connect('dbsrv2.cs.fsu.edu','egonzale','F4u$2G&P-a') or die('Could not connect to server'.mysql_error());
                mysql_select_db('egonzaledb') or die('Could not select db');

$result = mysql_query("SELECT * FROM user_auth");
?>

<div class = "container-fluid" style = "margin-top:5rem;">

  <?php

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
    $login = "Yes";
    break;
  }
}

if ($login != "Yes"){
  echo "Login Failed, Try Again";


?>

<div class="log-form">
  <h2>Login to your account</h2>
  <form action="./login_attempt.php" method='post'>
    <input type="text" name = "username" title="username" placeholder="username" />
    <input type="password" name = "password" title="username" placeholder="password" />
    <input type="submit" name="submit" value="Submit">
    <a class="forgot" href="./create_account.php">Create Account</a>
  </form>
</div>


<?php


}
mysql_close($link);
?>

</div>


<?php
mysql_close($link);
include 'footer.php';
?>
