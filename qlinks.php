  <?php 
  session_start();
  include "mysqlconnect.php";
  //$q = $_GET['q'];
  $qby = $_GET['qby'];
  $q_id = $_GET['qid'];

  //$_SESSION['q'] = $q;
  $_SESSION['qby'] = $qby;
  $_SESSION['qid'] = $q_id;
  $user=$_SESSION['user'];

  //$body = $_SESSION['body'];
  $count = 0;

  $f_query = "SELECT title,body from questions where question_id=?";
$prepare = $con->prepare($f_query);
$prepare->bind_param("s", $q_id);
$prepare->execute();
$response = $prepare->get_result();
$response = $response->fetch_assoc();

  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title><?php echo $response['title']; ?> </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <style type="text/css">
    body{
      background-color: #1a1a1a;
      color: #ff0000;
    }

    .username,.usernamea,.username-add{
      color: red;
      font-size: 25px;
    }

    .container,.container-add{
      color: white;
    }
    .entry,.entry-add{
      border-bottom: 1px solid red;
    }

    .question{
      font-size: 25px;
    }        

    .editAns,.ansBtn,.submitBtn{
      border-radius: 2px;
      background-color: red;
      color: white;
      border: none;
    }
    .ansBtn:hover{
      color: black;
    }
    .entry1{
      border-bottom: 1px solid white;
      font-size: 20px;
    }
    
    .inp{
      color: black; 
      width: 80%;
      height: 60px;
    }
    .hidden{
      display: none;
    }
    .like,.comment,.unlike,.submit-comment{
      font-size: 10;
      color: white;
      background-color: red;
      border: none;
      border-radius: 18px;
    }
    .like:hover,.comment:hover,.unlike:hover,.submit-comment:hover{
      cursor: pointer;
      color: black;
    }

    .small:hover{
      text-decoration: underline;
      cursor: pointer;
    }

    .small{
      font-size: 10px;
      color: white;
    }

    .logout{
     float: right;
     border-radius: 2px;
     background-color: red;
     color: white;
     border: none;
   }

   .logout:hover{
    color: black;
  }

  .navbar-default{
   background-color: black;
   border-color: red;
   color: orange;
   background-color: black;
 }

 .comment-field,.submit-comment,.commentDisp{
   display: none;
 }
 .link{
  color: white;
}
.link:hover
{
  color: white;
}
.search,.btn-primary{
  border-radius: 2px;
  float: right;
}
.search{
  width: 275px;
}
.like-outer{
  width: 250px;
  float: left;
}
.like-area{
  width:100%;
  float: left;
}
.like-area ul{
  list-style: none;
  margin: 0px
}
.like-area ul li{
  display: inline-block;
  margin: 0px 5px 0px 0px;
}
.like-area ul li a{
  width: 100%;
  padding: 10px;
  font-size: 25px;
  color: #000;
  cursor: pointer;
  float: left;
  user-select: none; /* Standard */
}
.like-no{
  font-size: 20px;
}
.like-area i{
  float: left;
}
.like-area .fas{
  font-size: 0px;
}
.like-active .fas{
 font-size: 25px;
}
.like-active .far{
 font-size: 0px;
}

.tite{
      color: black; 
      width: 80%;
      height: 30px;
    }

</style>
</head>
<body>

  <b style="color: orange;"><?php

  if(isset($_SESSION['user'])){  
    echo "Logged in as:".$_SESSION['user']; ?></b>
    <nav class="navbar navbar-default">
     <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="#"><?php $display_name = $_SESSION['user'];
     $query=mysqli_query($con,"SELECT user_level FROM users where display_name='$display_name'")or die(mysqli_error());
     $user_info = mysqli_fetch_assoc($query);
     echo "User Level: ".$user_info['user_level'];?></a>
     </div>
     <ul class="nav navbar-nav">
       <li><a href="homepage.php">Home</a></li>
       <li><a href="myquestions.php">My Questions</a></li>
       <li><a href="myanswers.php">My Answers</a></li>
     </ul>
     <form method="POST" action="search.php">
      <div style="padding-top: 10px;">
        <button type="submit" class="btn btn-primary" name="srchbtn">Go</button>
      </div>
      <div style="padding-top: 4px;">
        <input type="text" style="color: black;" class="search" name="srch" placeholder="Search for a question">
      </div>
    </form>
  </div>
</nav>

<button class='logout' id='logout'><span class="glyphicon glyphicon-log-out"></span>Logout</button><br><br>
<?php
$e_query = "SELECT title,body from questions where question_id=?";
$prepare = $con->prepare($e_query);
$prepare->bind_param("s", $q_id);
$prepare->execute();
$response = $prepare->get_result();
$response = $response->fetch_assoc(); 

$output = ""; 
if($response > 0){
$title = $response['title'];  
$body = $response['body'];

//echo $title;
  $d_query = "SELECT COUNT(*) AS num FROM answers WHERE question_id=?";
  $prepare = $con->prepare($d_query);	
  $prepare->bind_param("s", $q_id);
  $prepare->execute();
  $responses_query = $prepare->get_result();

//$responses_query = mysqli_query($con,"SELECT COUNT(*) AS num FROM answers WHERE question_id='$q_id'");
$no_response = $responses_query->fetch_assoc();
$responses = $no_response['num'];
$output = ""; 
$output .= "<div class='container'><div class='entry'><h2 class='username' style='color: orange;'><b><span class='glyphicon glyphicon-user'></span> ".$qby."</b></h2>";
$output .= "<h5 style='color:#33F6FF;' style='font-family:verdana;''>Question Title </h5>";
$output .= "<div class='question'>" . $response['title'] . "</div>";  
$output .= "<h3 style='color:red;' style='font-family:courier;''>Question Body</h3>";
$output .= "<h6>";
$output .= "<div class='question'>" . $body . "</div><br>"; 
$output .= "</h6>"; 
$output .= "<input class='hidden' id='hidden' value='".$_SESSION['user']."'>";
if($_SESSION['user'] == $_SESSION['qby']){
  $output .= "<h5 style='color:#33F6FF;' style='font-family:verdana;'>Edit Your Question Title</h5>";
  $output .="<div class='container'><textarea class='tite' id='NewTitle' name='question_title'>".$response['title']."</textarea></div>";
  $output .= "<h3 style='color:red;' style='font-family:courier;'>Edit Your Question Body</h3>";
  $output .= "<br><div class='container'><textarea class='inp' id='NewQues'>$body</textarea><br><button class='editAns' id='editQues' value='$q_id' onclick='EditQues()'>Submit</button></div>";
  $output .= "<br><button   style='margin:10px;' class='editAns' id='DelQues' value='$q_id' onclick='DeleteQues()'>Delete your Question</button>";
  
  $ques_status = mysqli_query($con,"SELECT question_status FROM questions WHERE question_id='$q_id'");
  $status=mysqli_fetch_assoc($ques_status);

  if($status['question_status'] == 'resolved'){    
    $output .= "<input type='radio' name='example1' id='Unresolve' onclick='Unresolve()' value='$q_id' /><label for='Unresolve'>Mark it back as Unresolved</label>";
    $output .= "<h4>This was marked as Resolved by you</h4>";
  }else if($status['question_status'] == 'unresolved'){
  $output .= "<input type='radio' name='example1' id='Resolve' onclick='Resolve()' value='$q_id' /><label for='Resolve'>Mark As resolved</label>";
  //$output .= "<input type='radio' name='example1' id='Unresolve' onclick='Unresolve()' value='$q_id' /><label for='Unresolve'>Mark As Unresolved</label>";
  }
  //$output .= "<br><button style='margin:10px;'class='editAns' id='Resolve' value='$q_id' onclick='Resolve()'>Mark As Resolved</button>";
  //$output .= "<br><button style='margin:10px;'class='editAns' id='Unresolve' value='$q_id' onclick='Unresolve()'>Mark As Unresolved</button>";
  }
$output .= "<br><div class='container'><div id='count' class='entry1'>".$responses." Answers under this question</div></div>";

$output .= "</div></div>"; 
$output .= "</div></div>";
$u=0;
if($responses > 0)
{

  //$get_responses = mysqli_query($con,"SELECT * FROM response WHERE response_to_user='$qby' AND response_to_question='$q'"); 
  $c_query = "SELECT * FROM answers WHERE question_id=?";
  $prepare = $con->prepare($c_query);	
  $prepare->bind_param("s", $q_id);
  $prepare->execute();
  $result = $prepare->get_result();
  //$get_responses = mysqli_query($con,"SELECT * FROM answers WHERE question_id='$q_id'");
  
  while($response_result = $result->fetch_assoc())
  {
    $u += 1;
    $r = $response_result['answer_text'];
    $rby = $response_result['answerer_display_name'];
    $r_id = $response_result['answer_id'];
    $output .= "<div class='container'><div class='entry'><h2 class='username' style='color: orange;'><b><span class='glyphicon glyphicon-user'></span> ".$rby."</b></h2>";
    //$output .= "<div class='container'><div class='entry'><h2 style='color: orange;' class='usernamea'>".$rby."</h2>";
    $output .= "<div class='answer'>".$r."</div><br>";
    //echo '<script type="text/javascript">alert('likes".$u."()'");</script>';
    $output.="<button class='btn btn-danger type='submit' name='like' id='likebtn".$u."' value='$r_id' onclick='likes".$u."()'><i class='fas fa-thumbs-up'></i> Like <span class='badge badge-light'></span></button>";
    $output .= "\t\t<button class='btn btn-danger' type='submit' name='dislike' id='dislikebtn".$u."' value='$r_id' onclick='dislikes".$u."()'><i class='fas fa-thumbs-up'></i> Dislike <span class='badge badge-light'></span></button>";
    $output .= "\t\t<button class='btn btn-danger' type='submit' name='flag' id='flagbtn".$u."' value='$r_id' onclick='flag".$u."()'><i class='fas fa-thumbs-up'></i> Flag <span class='badge badge-light'></span></button>";
    if($_SESSION['user'] == $_SESSION['qby']){
      $ans_status = mysqli_query($con,"SELECT is_best,is_accepted FROM answers WHERE question_id='$q_id' AND answer_id = '$r_id'");
      $status=mysqli_fetch_assoc($ans_status);

      $best_ans_status = mysqli_query($con,"select count(*) as cnt from answers where question_id = '$q_id' and is_best = 1;");
      $b_status=mysqli_fetch_assoc($best_ans_status);

    if($status['is_best']){
      
      $output .= "\t\t<input type='checkbox' id='accepted".$u."' checked name='accepted".$u."' value='$r_id'>";
      $output .= "\t\t<label for='accepted'>Mark As Accepted</label>";
  
      $output .= "\t\t<input type='checkbox' checked name='best".$u."' id = 'best".$u."' value='$r_id'>";
      $output .= "\t\t<label for='best'>Mark As Best</label>";

      $output .= "<h5>This was marked best answer by you</h5>";
    }else if($status['is_accepted']){
      $output .= "\t\t<input type='checkbox' id='accepted".$u."' checked name='accepted".$u."' value='$r_id'>";
      $output .= "\t\t<label for='accepted'>Mark As Accepted</label>";
  
      $output .= "\t\t<input type='checkbox' name='best".$u."' id = 'best".$u."' value='$r_id'>";
      $output .= "\t\t<label for='best'>Mark As Best</label>";

      $output .= "<h5>This was marked accepted answer by you</h5>";
    }else if(!$status['is_best'] && !$status['is_accepted']){
      $output .= "\t\t<input type='checkbox' id='accepted".$u."' name='accepted".$u."' value='$r_id'>";
      $output .= "\t\t<label for='accepted'>Mark As Accepted</label>";
  
      $output .= "\t\t<input type='checkbox' disabled= 'disabled' name='best".$u."' id = 'best".$u."' value='$r_id'>";
      $output .= "\t\t<label for='best'>Mark As Best</label>";
    }
  }
    if($_SESSION['user'] == $rby){
    $output .= "<h3 style='color:green;'>Edit Your Answer</h3>";
    $output .= "<br><div class='container'><textarea class='inp' id='TextAns".$u."'>$r</textarea><br><button class='editAns' id='editAns".$u."' value='$r_id' onclick='Edit".$u."()'>Submit</button></div>";
    $output .= "<br><div class='container'><button class='editAns' id='DelAns".$u."' value='$r_id' onclick='Delete".$u."()'>Delete your Answer</button></div>";
    }
    $output .= "<br>";
    $output .= "</div></div>";

  }
}

$output .= "\t\t<div class='container'><h3 style='color:rgb(128, 128, 0)'>Add New Answer</h3></div>";
$output .= "<br><div class='container'><textarea class='inp' id='inpAns'></textarea><br><button class='submitBtn' id='submitAns' onclick='submit()'>Submit</button></div>";
//$output .= "</h3><input id='q' style='display: none;' value='".$q_id."'>";
  

?>
<?php } ?>
<script type="text/javascript">	



  document.getElementById('logout').onclick=function(){
    window.location="login.php";
  };
  
  //var count=0;
  
  <?php for($z=0;$z<=$u;$z++) { ?>
   function likes<?php echo $z; ?>()
   {
      //alert("likebtn"+<?php echo $z; ?>);
     var answer_id=document.getElementById("likebtn"+<?php echo $z; ?>).value; 
     var votetype ="upvote";
     
     $.ajax({
       method: "POST",
       url: "likeresponse.php",
       data: {answer: answer_id,type:votetype},
       success: function(status) {
         $("#success").text(status);
         //location.reload();
       }

     });
   }
   <?php } ?>


 

   <?php for($z=0;$z<=$u;$z++) { ?>
   function dislikes<?php echo $z; ?>()
   { 
    var answer_id=document.getElementById("dislikebtn"+<?php echo $z; ?>).value; 
     var votetype ="downvote";
     //(answer_id);
     $.ajax({
       method: "POST",
       url: "likeresponse.php",
       data: {answer: answer_id,type:votetype},
       success: function(status) {
         $("#success").text(status);
         //location.reload();
       }
     });
   }
   <?php } ?>
   <?php for($z=0;$z<=$u;$z++) { ?>
   function flag<?php echo $z; ?>()
   { 
    var answer_id=document.getElementById("flagbtn"+<?php echo $z; ?>).value; 
     var votetype ="flagged";
     $.ajax({
       method: "POST",
       url: "likeresponse.php",
       data: {answer: answer_id,type:votetype},
       success: function(status) {
         $("#success").text(status);
         //location.reload();
       },
       error: function(){
          alert("error");
        }

     });
   }
   <?php } ?>
   /*function enableBest() {
  // Get the checkbox
  var outer_checkBox = document.getElementById("accepted");
  var inner_checkBox = document.getElementById("best");
  // If the checkbox is checked, display the output text
  var isbest=0;
  var isaccepted=0;
  if (outer_checkBox.checked == true && inner_checkBox.checked == true)
  {
    isbest=1;
    isaccepted=1;
  }
  else if (outer_checkBox.checked == false && inner_checkBox.checked == true){
    alert("Best answer has to be accepted!");
    outer_checkBox.checked = true; 
    isbest=1;
    isaccepted=1;

  } 
else {
  isbest=0;
  isaccepted=1;
  }
  $.ajax({
            method: "POST",
            url: "markanswer.php",
            data: {answer: answer_id, is_best: is_best,is_accepted:isaccepted},
            success: function(status) {
              alert(status);
            $("#success").text(status);
        

}*/


//    $("input[name=accepted]").change(function() {
//     var checked = $(this).attr("checked");
//     $(this).next().attr("disabled", !checked);
// });


<?php for($z=0;$z<=$u;$z++) { ?>
   $(document).ready(function() {
    $('input[type=checkbox][name=best'+<?php echo $z; ?>+']').change(function() {
        if ($(this).prop("checked")) {
          var answer_id= this.value;
          var is_best = 1;
          //alert(`${answer_id} is checked`);
            alert(`${this.value} is checked`);
            $.ajax({
            method: "POST",
            url: "markanswer.php",
            data: {answer: answer_id, is_best: is_best},
            success: function(status) {
              //alert(status);
            $("#success").text(status);
            location.reload();
       }
     });
        }
        else {
            //alert(`${this.value} is unchecked`);
            var answer_id= this.value;
            var is_best = 0;
            $.ajax({
            method: "POST",
            url: "markanswer.php",
            data: {answer: answer_id, is_best: is_best},
            success: function(status) {
            $("#success").text(status);
            location.reload();
        }
    });
}});
    });
<?php } ?>



<?php for($z=0;$z<=$u;$z++) { ?>
$(document).ready(function() {
    $('input[type=checkbox][name=accepted'+<?php echo $z; ?>+']').change(function() {
        if ($(this).prop("checked")) {
          //alert(`${this.value} is checked`);
          $('#best'+<?php echo $z; ?>).removeAttr("disabled");    

          var answer_id= this.value;
          var is_accepted = 1;   
                    
            $.ajax({
            method: "POST",
            url: "markanswer.php",
            data: {answer: answer_id, is_accepted: is_accepted},
            success: function(status) {
            $("#success").text(status);
            location.reload();
       }
     });
        }
        else {

          var inner_checkBox = document.getElementById("best"+<?php echo $z; ?>);
          var outer_checkbox =  document.getElementById("accepted"+<?php echo $z; ?>);
          if(inner_checkBox.checked == true)
          {
            alert("A best answer is always an accepted answer");
            outer_checkbox.checked=true;
          }
          //alert(`${this.value} is unchecked`);
          if(outer_checkbox.checked==false)
          {
          $('#best'+<?php echo $z; ?>).attr("disabled", "disabled");
      
          var answer_id= this.value;
            var is_accepted = 0;         
            $.ajax({
            method: "POST",
            url: "markanswer.php",
            data: {answer: answer_id, is_accepted: is_accepted},
            success: function(status) {
            $("#success").text(status);
            location.reload();
            }
        
     });
    }
        }
    });
});

<?php } ?>

<?php for($z=0;$z<=$u;$z++) { ?>
   function Edit<?php echo $z; ?>()
   { 
    var answer_id=document.getElementById("editAns"+<?php echo $z; ?>).value; 
    //alert("Updating "+ answer_id);
    var response=document.getElementById("TextAns"+<?php echo $z; ?>).value;
    //alert("Updating "+ response);

   document.getElementById("TextAns"+<?php echo $z; ?>).value = "";
   //console.log(response);
    if(response!="")
    {
     $.ajax({
       method: "POST",
       url: "editNdelAnswer.php",
       data: {answer_id: answer_id,edit_response: response},
       success: function(status) {
         //alert(status);
         $("#success").text(status);
         location.reload();
       },
       error: function(error){
        alert(error);
          //alert("error");
        }

     });
    }
    else
    {
      alert("Answer text cannot be empty");
    }
   }
   <?php } ?>

   <?php for($z=0;$z<=$u;$z++) { ?>
   function Delete<?php echo $z; ?>()
   { 
    var answer_id=document.getElementById("DelAns"+<?php echo $z; ?>).value; 
    //alert("Deleting "+ answer_id);
    
     $.ajax({
       method: "POST",
       url: "editNdelAnswer.php",
       data: {answer_id: answer_id},
       success: function(status) {
         alert(status);
         $("#success").text(status);
         location.reload();
       },
       error: function(){
          alert("error");
        }

     });
   }
   <?php } ?>


</script>

<script type="text/javascript">

 function submit()
 {
   var response=document.getElementById("inpAns").value;
   //var question_id=document.getElementById("q").value;
   document.getElementById("inpAns").value = "";
   //console.log(response);
   var user=document.getElementById("hidden").value;   
   if(response != "")
   {
     $.ajax({
       method: "POST",
       url: "inputresponse.php",
       data: {response: response},
       success: function(status) {
         $("#success").text(status);
         //alert(status);
         location.reload();
       },
       error: function(){
          alert("error");
        }
     });
   }
   else
   {
     alert("Answer body cannot be empty");
   }
 }

</script>

<script type="text/javascript">

 function EditQues()
 {
   var ques=document.getElementById("NewQues").value;
   var title=document.getElementById("NewTitle").value;
   var question_id=document.getElementById("editQues").value;
   //alert(ques + title + question_id);
   document.getElementById("NewQues").value = "";
   document.getElementById("NewTitle").value = "";
   var user=document.getElementById("hidden").value;   
   if(ques != "" && title != "")
   {
     $.ajax({
       method: "POST",
       url: "editNdelquestion.php",
       data: {ques: ques,title: title, question_id: question_id},
       success: function(status) {
         $("#success").text(status);
         //alert(status);
         location.reload();
       },
       error: function(error){
        alert(error);
          alert("error");
        }
     });
   }
   else
   {
     alert("Both title and description cannot be empty");
   }
 }


 function DeleteQues()
 {
   var question_id=document.getElementById("DelQues").value;
   var user=document.getElementById("hidden").value;   
   if(question_id != "")
   {
     $.ajax({
       method: "POST",
       url: "editNdelquestion.php",
       data: {question_id: question_id},
       success: function(status) {
         $("#success").text(status);
         //alert(status);
         location.reload();
       },
       error: function(){
          alert("error");
        }
     });
   }
 }


 function Resolve()
 {
   var question_id=document.getElementById("Resolve").value;  
   if(question_id != "")
   {
     $.ajax({
       method: "POST",
       url: "Resolve.php",
       data: {question_id: question_id, flag: 1},
       success: function(status) {
         $("#success").text(status);
         //alert(status);
         location.reload();
       },
       error: function(){
          alert("error");
        }
     });
   }
 }

 function Unresolve()
 {
   var question_id=document.getElementById("Unresolve").value;  
   if(question_id != "")
   {
     $.ajax({
       method: "POST",
       url: "Resolve.php",
       data: {question_id: question_id, flag: 0},
       success: function(status) {
         $("#success").text(status);
         //alert(status);
         location.reload();
       },
       error: function(){
          alert("error");
        }
     });
   }
 }

</script>
<?php echo $output; ?>

<?php } ?>
</body>
</html>
