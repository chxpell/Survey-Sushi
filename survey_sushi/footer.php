



<!--

Survey Question Form JavaScript

Must be in .php file because php session variables are being used.

-->

<script>

var remaining_questions = <?php echo $_SESSION['numquestions'] ?>;
var question_descriptions = [];
var question_num = 0;
var question_answers = [[],[]];
var survey = {};
var email = "";
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

<!-- Bootstrap & jQuery -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

<!-- Firebase Config -->
<script src="https://www.gstatic.com/firebasejs/5.1.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.1.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.1.0/firebase-database.js"></script>

<!--


Firebase JavaScript

• User Authentication
• User Creation
• Survey Creation

-->


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
    console.log("Logged In");
    LoggedIn();
    document.getElementById("login").style.display = "none";
    document.getElementById("welcome").style.display = "block";
    document.getElementById("survey").style.display = "block";
    document.getElementById("survey2").style.display = "block";
    document.getElementById("logout").style.display = "block";
    document.getElementById("welcome").innerHTML = "Online: " + firebaseUser.email;
    email = firebaseUser.email;
  } else {
    console.log("Not Logged In")
  }
});

function Logout(){
  firebase.auth().signOut();
  document.getElementById("login").style.display = "block";
  document.getElementById("welcome").style.display = "none";
  document.getElementById("survey").style.display = "none";
  document.getElementById("survey2").style.display = "none";
  document.getElementById("logout").style.display = "none";
  location.replace("http://ww2.cs.fsu.edu/~egonzale/survey_sushi/");
}




function LoggedIn(){
  var welcome_2 = document.getElementById("Welcome2");
    var imIn = document.getElementById("imIn");
  var createform = document.getElementById("CreateForm");
  var login_form = document.getElementById("login_form");
  if (welcome_2){
    welcome_2.style.display = "block";
  }

  if (createform){
    createform.style.display = "none";
  }

  if (login_form){
    login_form.style.display = "none";
  }

  if (imIn){
    imIn.style.display = "block";
  }

}

function writeSurvey(){
var id_gen = Math.floor((Math.random() * 100000000) + 1);
var survey_id = "survey" + id_gen;
document.getElementById("surveyId").innerHTML = id_gen;

survey.user = email;
survey.name = "<?php echo $_SESSION['survey_name'] ?>";
survey.description = "<?php echo $_SESSION['description'] ?>";
survey.company = "<?php echo $_SESSION['company'] ?>";
survey.question_descriptions = question_descriptions;
survey.question_answers = question_answers;
survey.surveyid = id_gen;
survey.num_questions = "<?php echo $_SESSION['questions'] ?>";

  firebase.database().ref('/surveys/' + survey_id).set(survey);

var responses = [[],[]];

for (var i =0; i < survey.question_descriptions.length; i++){
  for (var x = 0; x < survey.question_answers[i].length;x++){
  responses[i].push(0);
}
}

survey2.question_data = responses;
survey2.surveyid = id_gen;

firebase.database().ref('/responses/' + survey_id).set(survey2);


}

function grabSurveys(){

var num_surveys = 0;

var rootquery = firebase.database().ref();
var query = rootquery.child("/surveys");

query.on("child_added", function(data){
  if (data.val().user == email){
    num_surveys++;
    var html = document.getElementById("analytics_div").innerHTML;

    html = html + "<div class = 'col-sm-4 text-center'>" + "<h3>" +
    "Survey " + num_surveys + "</h3>" + "<p><b>Id:</b> " + data.val().surveyid + "</p>" +
     "<p><b>Name:</b> " + data.val().name + "</p>" + "<p><b>Description:</b> " + data.val().description +
      "</p>" + "<p><b>Company:</b> " + data.val().company + "</p>" +
      "<button onclick='get_analytics(" + data.val().surveyid +",\"" +
      data.val().name + "\"," + data.val().num_questions + ")' class='butt' placeholder='Submit'>" +
      "See Analytics </button>" + "</div>";

    document.getElementById("analytics_div").innerHTML = html;
  }
});
}

function get_analytics(id,name,num){

document.getElementById("info_slide").style.display = "none";
document.getElementById("analytics_close").style.display = "block !important";
  var rootquery = firebase.database().ref();
  var query = rootquery.child("/responses");
  var x = num;



// Grabbing Questions / Descriptions for Display
  var answers = [[],[]];
  var descriptions = [];
  var query2 = rootquery.child("/surveys");

  query2.on("child_added", function(data){
    if (data.val().surveyid == id){
answers = data.val().question_answers;
descriptions = data.val().question_descriptions;
    }
  });



  document.getElementById("analytics_slide").style.display = "block";


  query.on("child_added", function(data){
    if (data.val().surveyid == id){
      var html = document.getElementById("analytics_slide").innerHTML;


// Title
      html = "<div class ='row text-center s_title'>" + name + "<p class = ''" +
      "> Analytics </p>" + "</div>";
//Questions Loop

var question = 1;
var responses = [[],[]];
var data2 = [];

for(let i = 0; i < data.val().question_data.length; i++){
html = html + "<div class = 'row a_title '>" +
"<div class = 'col-sm-6'> Question" + question;


html = html + "<div>" + descriptions[(question-1)] + "</div>";
  for ( b=0; b < answers[question-1].length; b++){
    html = html + "<p>" + (b+1) + ") " + answers[(question-1)][b] + "</p>";
  }




html = html + " </div>" +
"<div class = 'col-sm-6 chartcol'><canvas id='myChart" + question +
"'width = '200' height = '200'></canvas> </div></div>";

document.getElementById("analytics_slide").innerHTML = html;

  document.getElementById("analytics_close").style.display = "block";

  for (let j = 0; j < data.val().question_data[i].length; j++){
responses[i].push(data.val().question_data[i][j]);
  }



question++;
}


      document.getElementById("analytics_slide").innerHTML = html;
      printGraph(responses);

    }
  });



}

function printGraph(responses){

  var numofQuestions = [[],[]];

for (var i = 0; i < responses.length; i++){

for (var j = 0; j < responses[i].length; j++){
  numofQuestions[i].push("Answer" + (j+1));
}



  var chart_id = "myChart" +(i+1);
  console.log(chart_id);
  console.log(responses[i]);

var ctx = document.getElementById(chart_id).getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: numofQuestions[i],
        datasets: [{
            label: '# of Responses',
            data: responses[i],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

numofQuestions = [[],[]];
}

}

function close_analytics (){
    document.getElementById("analytics_slide").style.display = "none";
    document.getElementById("analytics_close").style.display = "none";
    document.getElementById("info_slide").style.display = "block";
}


grabSurveys();


</script>

</body>
</html>
