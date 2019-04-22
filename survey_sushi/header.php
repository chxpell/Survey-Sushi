<!DOCTYPE html>

<!--

Survey Sushi

header.php
- Nav menu
- Online Status / Logout Buttons
- Main CSS/JS References

-->




<!-- jQuery -->
<script type = "text/javascript"
         src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>

<?php session_start(); ?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Survey Sushi</title>

    <!-- Bootstrap core CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Survey Sushi CSS -->
<link href="./main.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style = "
    background:#cf5351;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://ww2.cs.fsu.edu/~egonzale/survey_sushi/">Survey Sushi</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav" style = "">
            <li class=""><a href="http://ww2.cs.fsu.edu/~egonzale/survey_sushi/">Home</a></li>
            <li id = "login" ><a href="http://ww2.cs.fsu.edu/~egonzale/survey_sushi/login.php">Login</a></li>
            <li id = "survey" ><a href="http://ww2.cs.fsu.edu/~egonzale/survey_sushi/create_survey.php">Create Surveys</a></li>
            <li><a href="http://ww2.cs.fsu.edu/~egonzale/survey_sushi/references.php">References</a></li>



          </ul>
        </div><!--/.nav-collapse -->
        <div id = "logout" style = "display:none; float:right; color:white;">
          <button id = "btnLogout" onclick = "Logout()"class = "butt" placeholder = "Submit" onclick = "">
      Logout
      </button>
        </div>
        <div id = "welcome" style = "float:right; color:white; display:none;
        margin-right:2rem;">
      </div>
      </div>
    </div>
