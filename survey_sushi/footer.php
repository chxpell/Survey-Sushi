<!-- Bootstrap core JavaScript
================================================== -->
<style>
.butt{
  padding-top: 1rem;
  padding-left:2rem;
  padding-right:2rem;
  padding-bottom:1rem;
}

</style>

<script>

var remaining_questions = <?php echo $_SESSION['numquestions'] ?>;
var question_descriptions = [];
var question_num = 0;
var question_answers = [[],[]];
var survey = {};

/*
Takes in Question Generator Description & Number of Answers
Next Step is to Take in Question Answers with SubmitQuestionData()
*/

function SubmitFormData() {
    var description = $("#description").val();
    var answers = $("#answers").val();
    question_descriptions[question_num] = description;

    // Info Display Above Answer Input Boxes
    var html = "<div class = 'row' id = 'question_info'> <div class = 'col-sm-6 text-center'>" +
     "<h1>Question:</h1><div>" + description +
     "</div></div> <div class = 'col-sm-6 text-center'> <h1> Number of Answers </h1> <div>"
     + answers + "</div> </div>";
    document.getElementById("output").innerHTML = html;

    // Generate Answer Input Boxes Based on Number of Answers
    QuestionGenerator(answers,html);
    document.getElementById("myForm").style.display = "none";

}


/* Takes in Question Answers */
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
    // Displaying Form Output for Testing Purposes
y = x - num_questions;
answersid = answersid + y;
answer_data = $(answersid).val();
answer_string = answer_string + answer_pt1 + answer_data + answer_pt2;
answersid = answersid.substring(0, answersid.length - 1);
num_questions--;

// Saving Individual Answers to Variable Array
question_answers[question_num][y-1] = answer_data;
}

document.getElementById("output_2").innerHTML = answer_string;
$('#myForm').children('input').val('');
$('#myForm').children('textarea').val('');
$('#submitFormData').val('Submit');

document.getElementById("myForm").style.display = "block";
document.getElementById("question_form").style.display = "none";
document.getElementById("question_info").style.display = "none";
remaining_questions--;
question_num++;

if (remaining_questions == 0){
  document.getElementById("surveyComplete").style.display = "none";
  document.getElementById("surveyComplete2").style.display = "block";
  writeSurvey();
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



<!-- Firebase Config -->
<script src="https://www.gstatic.com/firebasejs/5.1.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.1.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.1.0/firebase-database.js"></script>
<script>


  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCBibS9vdRzuhG4jFiFLFpbZGeV8osRo70",
    authDomain: "survey-sushi-9580d.firebaseapp.com",
    databaseURL: "https://survey-sushi-9580d.firebaseio.com",
    projectId: "survey-sushi-9580d",
    storageBucket: "survey-sushi-9580d.appspot.com",
    messagingSenderId: "881485953377"
  };

  firebase.initializeApp(config);

const btnLogin = document.getElementById("btnLogin");
const btnCreate = document.getElementById("btnCreate");
const btnLogout = document.getElementById("btnLogout");

// Login Function
if (btnLogin){
btnLogin.addEventListener('click',e=>{
  const email = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const auth = firebase.auth();

  const error = auth.signInWithEmailAndPassword(email,password);
  error.catch(e => console.log(e.message));
});
}

// Write User Function
if (btnCreate){
btnCreate.addEventListener('click',e=>{
  const email = document.getElementById("namefield").value;
  const password = document.getElementById("passfield").value;
  const auth = firebase.auth();

  const error = auth.createUserWithEmailAndPassword(email,password);
  error.catch(e => console.log(e.message));
});
}

// Listener
firebase.auth().onAuthStateChanged(firebaseUser =>{
  if (firebaseUser){
    console.log(firebaseUser)
    console.log("Logged In");
    document.getElementById("login").style.display = "none";
    document.getElementById("welcome").style.display = "block";
    document.getElementById("survey").style.display = "block";
    document.getElementById("logout").style.display = "block";
    document.getElementById("welcome").innerHTML = "Online: " + firebaseUser.email;
  } else {
    console.log("Not Logged In")
  }
});

function Logout(){
  firebase.auth().signOut();
  document.getElementById("login").style.display = "block";
  document.getElementById("welcome").style.display = "none";
  document.getElementById("survey").style.display = "none";
  document.getElementById("logout").style.display = "none";
}

function LoggedIn(){
  if (firebaseUser){
    document.getElementById("welcome2").style.display = "block";
    document.getElementById("CreateForm").style.display = "none";
  }
}

function writeSurvey(){
var id_gen = Math.floor((Math.random() * 100000000) + 1);
var survey_id = "survey" + id_gen;
document.getElementById("surveyId").innerHTML = id_gen;

survey.name = "<?php echo $_SESSION['survey_name'] ?>";
survey.description = "<?php echo $_SESSION['description'] ?>";
survey.company = "<?php echo $_SESSION['company'] ?>";
survey.question_descriptions = question_descriptions;
survey.question_answers = question_answers;
survey.num_questions = "<?php echo $_SESSION['questions'] ?>";

  firebase.database().ref(survey_id).set(survey);


}


</script>

</body>
</html>
