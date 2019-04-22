<?php include 'header.php'; ?>


<div class = 'container-fluid'>

<div class="log-form" id = "CreateForm">
  <h2>Account Creation</h2>
    <input type="text" id = "namefield" title="username" placeholder="email" />
    <input type="password" id = "passfield" title="username" placeholder="password" />
    <button id = "btnCreate" class = "butt" placeholder = "Submit" onclick = "">
Create Account
</button>
</div>

<div id = "Welcome2" style = "display:none;">
Account Successfully Created!
</div>

</div>

<?php include 'footer.php'; ?>
