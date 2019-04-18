<!-- Bootstrap core JavaScript
================================================== -->

<?php

$name = $_SESSION['name'];
$online = $_SESSION['status'];
if ($online == "online"){
  echo '<script type="text/javascript">',
   'LoggedIn("',
   $name,
   '");',
   '</script>';
}
?>

<script>

var remaining_questions = <?php echo $_SESSION['numquestions']; ?>;

/*

Takes in Question Generator Description & Number of Answers

Next Step is to Take in Question Answers with SubmitQuestionData()

*/
function SubmitFormData() {
    var description = $("#description").val();
    var answers = $("#answers").val();
    var html = "<div class = 'row' id = 'question_info'> <div class = 'col-sm-6 text-center'>" +
     "<h1>Question:</h1><div>" + description +
     "</div></div> <div class = 'col-sm-6 text-center'> <h1> Number of Answers </h1> <div>"
     + answers + "</div> </div>"; //call the php add function
    document.getElementById("output").innerHTML = html;
    QuestionGenerator(answers,html);
    document.getElementById("myForm").style.display = "none";



}


/*

Takes in Question Answers

*/
function SubmitQuestionData(num_questions) {
  var x = num_questions + 1;
  var answers = ["Null"];
  var answersid = "#answers";
  var answer_pt1 = "<div class = 'row text-center'> ";
  var answer_data = "";
  var answer_pt2 = "</div> ";
  var answer_string = "";
  var y = 0;


  while (num_questions > 0){
y = x - num_questions;

answersid = answersid + y;

answer_data = $(answersid).val();


answer_string = answer_string + answer_pt1 + answer_data + answer_pt2;

answersid = answersid.substring(0, answersid.length - 1);
num_questions--;
}

document.getElementById("output_2").innerHTML = answer_string;
$('#myForm').children('input').val('');
$('#myForm').children('textarea').val('');
$('#submitFormData').val('Submit');
document.getElementById("myForm").style.display = "block";
document.getElementById("question_form").style.display = "none";
document.getElementById("question_info").style.display = "none";
remaining_questions--;

if (remaining_questions == 0){
  window.location.replace("http://ww2.cs.fsu.edu/~egonzale/survey_sushi/");
}

}





/*

Generates Form To Submit Question Answers Based
on # of Questions

*/
function QuestionGenerator(answers,html){
  var i = answers;
  var k = i;
  var num_questions = i;
  k++;

  var formstart = "<div class = 'text-center row' style = 'margin-top:10rem; font-size:2rem;'> Enter Your Answers <form id='question_form' method='post' style = ''>";
  var formend_pt1 = "<input style = 'margin-top:3rem;' type='button' id='submitFormData' onclick='SubmitQuestionData("
  var formend_pt2 = ");'' value='Submit' /> </form> </div>";
  var question_pt1 = "<input name='answers' id='answers"
  var question_pt2 = "' type='text' />";
  var questions = "";
  var k_i = 0;
  while (i>0){
    k_i = k-i;
    questions = questions + "<div> Answer " + k_i  +  "</div>" + question_pt1 +
    k_i + question_pt2 + "<br>";
    i--;
  }

  document.getElementById("output").innerHTML = html + formstart +
  questions + formend_pt1 + num_questions + formend_pt2;

}
</script>

<!-- Placed at the end of the document so the pages load faster -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
</body>
</html>
