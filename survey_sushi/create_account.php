<?php include 'header.php'; ?>

<div class = 'container-fluid'>

<div class="log-form">
  <h2>Account Creation</h2>
  <form action="./account_attempt.php" method='post'>
    <input type="text" name = "username" title="username" placeholder="username" />
    <input type="password" name = "password" title="username" placeholder="password" />
    <input type="submit" name="submit" value="Submit">
  </form>
</div>

</div>

<?php
include 'footer.php';
?>
