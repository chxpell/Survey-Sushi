<?php include 'header.php'; ?>

<!--

Survey Question Creation Page
• Stores previously submitted Survey Information
• Creates Amount of Questions based on Given Amount
• Gives SurveyID upon Survey Creation

-->



<!-- Saving Data From Previous Form -->
<?php

session_start();

$_SESSION['survey_name'] = $_POST['survey_name'];
$_SESSION['company'] = $_POST['company'];
$_SESSION['numquestions'] = $_POST['num_questions'];
$_SESSION['questions'] = $_POST['num_questions'];
$_SESSION['description'] = $_POST['description'];

 ?>



<!-- Survey Question / Answer Generation -->
 <div id = "surveyComplete" class = "container" style = "margin-top:5rem;">

   <h1>
Question Creator
   </h1>

<div class = "row">
<div class = "col-xs-12 text-center">
     <form id="myForm" method="post" style = "">
       <label style = "line-height:2rem;" for="">Question</label>
       <textarea rows="3" name = "description"
       id = "description" type="text" class="form-control"></textarea> <br/>
          Number Of Answers <input name="answers" id="answers" type="text" /> <br/>

         <input style = "margin-top:3rem;"
         type="button" id="submitFormData" onclick="SubmitFormData();" value="Submit" />
        </form>

      </div>


<div class = "col-sm-12">

  <!-- Survey Question / Num Answers Put Here -->
<div id = "output"></div>

<!-- Survey Answer Input Boxes Put Here -->
<div id = "output_2" style = "margin-top:5rem;"></div>
</div>

</div>
 </div>


<!-- Survey ID Display -->
 <div class = "container" id = "surveyComplete2" style = "display:none;
 margin-top:5rem;">
<p>
Your Survey Has Been Successfully Created!
</p>
<p>
Your Survey ID Is <p id = "surveyId"></p>
</p>
 </div>






<?php include 'footer.php'; ?>
