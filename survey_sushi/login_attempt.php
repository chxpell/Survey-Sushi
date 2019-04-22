<?php include 'header.php'; ?>



<div class="log-form">
  <h2>Login to your account</h2>
  <form action="./login_attempt.php" method='post'>
    <input type="text" name = "username" title="username" placeholder="username" />
    <input type="password" name = "password" title="username" placeholder="password" />
    <input type="submit" name="submit" value="Submit">
    <a class="forgot" href="./create_account.php">Create Account</a>
  </form>
</div>




</div>


<?php include 'footer.php'; ?>
