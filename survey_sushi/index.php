<?php include 'header.php'; ?>

<style>

.homepage_button{
  background: #5f2c82;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #49a09d, #5f2c82);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #49a09d, #5f2c82); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
padding:5rem;
color:white;
border-radius: 2rem;
}

.homepage_button:hover{
  text-decoration:none;
  -webkit-transition: all 2000ms ease;
-moz-transition: all 2000ms ease;
-ms-transition: all 2000ms ease;
-o-transition: all 2000ms ease;
transition: all 2000ms ease;
color:yellow;
}

</style>


    <div class="container">

<!-- Title Message -->
<div class "row" style = "margin-bottom:10rem;">
      <div class="starter-template">
        <h1>Survey Sushi</h1>
      </div>
    </div>

    <!-- Call to action buttons -->
      <div class = "row text-center">

        <div class = "col-sm-6" style = "">
          <a class = "homepage_button">
Looking to Create Surveys?
</a>
        </div>

        <div class = "col-sm-6">
            <a class = "homepage_button">
Have a Survey Access Code?
</a>
        </div>

      </div>


    </div><!-- /.container -->



<?php include 'footer.php'; ?>
