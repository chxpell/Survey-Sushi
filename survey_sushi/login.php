<?php include 'header.php'; ?>

<div class = "container">

  <div class="log-form">
    <h2>Login to your account</h2>
      <input type="text" id = "username" placeholder="username" />
      <input type="password" id = "password" placeholder="password" />
      <button id = "btnLogin" class = "butt" placeholder = "Submit" onclick = "">
Submit
      </button>
      <a class="forgot" href="./create_account.php">Create Account</a>
  </div>

</div>

<script>

function loginFormAttempt(){
    User = document.getElementById("username").value;
    Pass = document.getElementById("password").value;
    loginAttempt(User,Pass);
}

</script>


<?php include 'footer.php';?>
