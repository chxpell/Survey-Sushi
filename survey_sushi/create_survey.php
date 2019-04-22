<?php include 'header.php'; ?>

<!--

Survey Creation page
• Survey Creation Form
• Survey Creation Form JavaScript for Animations

-->



<div class = "container">

<div class = "row">

<div class = "col-sm-12 text-center" style = "margin-bottom:5rem; margin-top:7rem;">
<h1>
Survey Creator
</h1>
</div>

<hr>

<!-- Survey Creation Form -->
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



<!-- Contact Form Animation JavaScript -->
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
