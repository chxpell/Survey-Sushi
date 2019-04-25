<?php include 'header.php'; ?>


<div class = 'container-fluid'>

<div class="log-form text-center" id = "CreateForm">
  <h2>Create Account</h2>
    <input type="text" id = "namefield" title="username" placeholder="email" />
    <input type="password" id = "passfield" title="username" placeholder="password" />
    <button id = "btnCreate" class = "butt" placeholder = "Submit" onclick = "">
Create Account
</button>
<a class="forgot" href="./login.php">Login</a>
</div>

<div id = "Welcome2" style = "display:none;">
Account Successfully Created!
</div>

</div>

<?php include 'footer.php'; ?>
