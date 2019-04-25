<?php include 'header.php'; ?>

<!--


User Login Page
• Login Form

-->

<div class = "container">


<!-- User Login Form -->
  <div class="log-form text-center" id = "login_form">
    <h2>Login to your account</h2>
      <input type="text" id = "username" placeholder="username" />
      <input type="password" id = "password" placeholder="password" />
      <button id = "btnLogin" class = "butt" placeholder = "Submit" onclick = "">
Submit
      </button>
      <a class="forgot" href="./create_account.php">Create Account</a>
  </div>

  <div id = "imIn" class = "row" style = "margin-top:10rem; display:none;">
You Have Been Successfully Logged In!
<img src = "./images/happysushi.png" style = "height:10rem; width:auto;
margin-top:4rem;">
  </div>

</div>



<?php include 'footer.php';?>
