<?php include 'header.php'; ?>







<div class = "col-sm-12">
<h1> Analytics </h1>
<p> Your Surveys and Their Anayltics Will Appear Here </p>
</div>



<div id = "info_slide">

<div class = "container-fluid" id = "analytics_div">

</div>
</div>
<div class = "container-fluid" id = "analytics_close" style = "display:none;">
<button class = "butt" onclick = 'close_analytics()' style = ""> X </button>

</div>
<div id = "analytics_slide" class = "container-fluid" style = "display:none;">

</div>


<style>
#analytics_close{
float: right;
}

#analytics_slide{

width:100%;
height:100rem;
background:white;
z-index:10000000000;

}

.s_title{
  font-size:5.5rem;
}

.s_title p{
  font-size: 2.5rem;
}

.a_title{
  font-size:3.5rem;
}


}

</style>






<?php include 'footer.php'; ?>
