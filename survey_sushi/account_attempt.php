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


$username_check = "0";
while($LOL = mysql_fetch_array($result))
{
if ($LOL['username'] == $_SESSION['name']){
    echo "Username Already Exists";
    $username_check = "1";
  }
}

if ($username_check == "0"){


      $name = $_SESSION['name'];
      $pass = $_SESSION['password'];

      $creation = mysql_query("INSERT INTO user_auth (username, password)
      VALUES ('$name', '$pass')");


  if(! $creation ) {
     die('Could not enter data: ' . mysql_error());
  }

  echo "<h1 style = margin-bottom:5rem;>",
  "Your Account Has Been Created!",
  "</h1>",
  "<h1> Welcome &nbsp",
  $name,
  "</h1>";

} else {

?>

<div class="log-form">
  <h2>Account Creation</h2>
  <form action="./account_attempt.php" method='post'>
    <input type="text" name = "username" title="username" placeholder="username" />
    <input type="password" name = "password" title="username" placeholder="password" />
    <input type="submit" name="submit" value="Submit">
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
