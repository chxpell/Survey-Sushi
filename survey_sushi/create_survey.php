<?php include 'header.php'; ?>

<div class = "container">

<div class = "row">

<div class = "col-sm-12" style = "margin-bottom:5rem; margin-top:5rem;">
<h1>
Survey Creator
</h1>
</div>

<hr>

<div class = "col-sm-12">
  <section class="contact-wrap">
    <form action="./survey_attempt.php" class="contact-form" method='post'>
<div class = "row">
      <div class="col-sm-12">
        <div class="input-block">
          <label for="">Survey Name</label>
          <input name = "survey_name" type="text" class="form-control">
        </div>
      </div>
      <div class="col-sm-12">
        <div class="input-block">
          <label for="">Survey Company</label>
          <input name = "company" type="text" class="form-control">
        </div>
      </div>
      <div class="col-sm-12" style = "">
        <div class="input-block">
          <label for="">Maximum Survey Takers (If No Limit Type "N/A")</label>
          <input name = "max_attempts" type="text" class="form-control">
        </div>
      </div>
      <div class="col-sm-12">
        <div class="input-block">
          <label for="">Desired Amount of Questions</label>
          <input name = "num_questions" type="text" class="form-control">
        </div>
      </div>
      <div class="col-sm-12">
        <div class="input-block textarea">
          <label style = "line-height:2rem;" for="">Survey Description (What Your Survey Takers
            Will Read Before Taking The Survey)</label>
          <textarea rows="3" name = "description" type="text" class="form-control"></textarea>
        </div>
      </div>
      <div class="col-sm-12">
        <button class="square-button">Start Making Questions</button>
      </div>
    </div>
    </form>
  </section>


</div>





</div>

</div>


<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900);
.contact-form {
  margin-top: 30px;
}
.contact-form .input-block {
  background-color: rgba(255, 255, 255, 0.8);
  border: solid 1px #4B4453;
  width: 100%;
  height: 60px;
  padding: 5rem;
  position: relative;
  margin-bottom: 20px;
  -moz-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  -webkit-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
}
.contact-form .input-block.focus {
  background-color: #fff;
  border: solid 1px #fb2900;
}
.contact-form .input-block.textarea {
  height: auto;
}
.contact-form .input-block.textarea .form-control {
  height: auto;
  resize: none;
}
.contact-form .input-block label {
  position: absolute;
  left: 25px;
  top: 25px;
  display: block;
  margin: 0;
  font-weight: 300;
  z-index: 1;
  color: #333;
  font-size: 18px;
  line-height: 10px;
}

.contact-form .input-block input {
margin-top:1.5rem;
}

.contact-form .input-block textarea {
margin-top:1.5rem;
}
.contact-form .input-block .form-control {
  background-color: transparent;
  padding: 0;
  border: none;
  -moz-border-radius: 0;
  -webkit-border-radius: 0;
  border-radius: 0;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  height: auto;
  position: relative;
  z-index: 2;
  font-size: 18px;
  color: #333;
}
.contact-form .input-block .form-control:focus label {
  top: 0;
}
.contact-form .square-button {
  background-color: rgba(255, 255, 255, 0.8);
  color: black;
  font-size: 26px;
  text-transform: uppercase;
  font-weight: 700;
  text-align: center;
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-transition: all 0.3s ease;
  -o-transition: all 0.3s ease;
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
  padding: 0 60px;
  height: 60px;
  border: none;
  width: 100%;
}
.contact-form .square-button:hover, .contact-form .square-button:focus {
  background-color: white;
}

@media (min-width: 768px) {
  .contact-wrap {
    width: 60%;
    margin: auto;
  }
}
/*----page styles---*/


.contact-wrap {
  padding: 15px;
}

h1 {
  background-color: white;
  color: black;
  padding: 40px;
  margin: 0 0 50px;
  font-size: 30px;
  text-transform: uppercase;
  font-weight: 700;
  text-align: center;
}
h1 small {
  font-size: 18px;
  display: block;
  text-transform: none;
  font-weight: 300;
  margin-top: 10px;
  color: #ff7c62;
}

.made-with-love {
  margin-top: 40px;
  padding: 10px;
  clear: left;
  text-align: center;
  font-size: 10px;
  font-family: arial;
  color: #fff;
}
.made-with-love i {
  font-style: normal;
  color: #F50057;
  font-size: 14px;
  position: relative;
  top: 2px;
}
.made-with-love a {
  color: #fff;
  text-decoration: none;
}
.made-with-love a:hover {
  text-decoration: underline;
}

</style>

<script>
//material contact form animation
$('.contact-form').find('.form-control').each(function() {
  var ta//material contact form animation
  $(".contact-form")
    .find(".form-control")
    .each(function() {
    var targetItem = $(this).parent();
    if ($(this).val()) {
      $(targetItem)
        .find("label")
        .css({
        top: "10px",
        fontSize: "14px"
      });
    }
  });
  $(".contact-form")
    .find(".form-control")
    .focus(function() {
    $(this)
      .parent(".input-block")
      .addClass("focus");
    $(this)
      .parent()
      .find("label")
      .animate(
      {
        top: "10px",
        fontSize: "14px"
      },
      300
    );
  });
  $(".contact-form")
    .find(".form-control")
    .blur(function() {
    if ($(this).val().length == 0) {
      $(this)
        .parent(".input-block")
        .removeClass("focus");
      $(this)
        .parent()
        .find("label")
        .animate(
        {
          top: "25px",
          fontSize: "18px"
        },
        300
      );
    }
  });
rgetItem = $(this).parent();
  if ($(this).val()) {
    $(targetItem).find('label').css({
      'top': '10px',
      'fontSize': '14px'
    });
  }
})
$('.contact-form').find('.form-control').focus(function() {
  $(this).parent('.input-block').addClass('focus');
  $(this).parent().find('label').animate({
    'top': '10px',
    'fontSize': '14px'
  }, 300);
})
$('.contact-form').find('.form-control').blur(function() {
  if ($(this).val().length == 0) {
    $(this).parent('.input-block').removeClass('focus');
    $(this).parent().find('label').animate({
      'top': '25px',
      'fontSize': '18px'
    }, 300);
  }
})
</script>

<?php include 'footer.php'; ?>
