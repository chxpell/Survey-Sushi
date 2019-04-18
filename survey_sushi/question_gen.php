<?php
session_start();
if($_SESSION['numquestions'])>0{

  ?>

  <form id="question_form" method="post">
    <label style = "line-height:2rem;" for="">Question</label>
    <textarea rows="3" name = "description"
    id = "description" type="text" class="form-control"></textarea> <br/>
       Number Of Answers <input name="answers" id="answers" type="text" /> <br/>
      <input type="button" id="submitFormData" onclick="SubmitFormData();" value="Submit" />
     </form>

     <?php
}

 ?>
