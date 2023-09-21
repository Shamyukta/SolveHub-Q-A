<?php

session_start();
include "mysqlconnect.php";
echo '<script type="text/javascript">alert("Im updating");</script>';
//console.log("Im in"); 
if(isset($_POST['answer_id']))
{
  $answer_id = $_POST['answer_id'];
  if(isset($_POST['edit_response']))
  { 
    $edit_response = $_POST['edit_response'];
    //echo '<script type="text/javascript">alert("Im updating");</script>';
    $edit_response = mysqli_query($con,"UPDATE answers SET answer_text = '$edit_response' WHERE answer_id = '$answer_id'");
  }
  else
  {
    //echo '<script type="text/javascript">alert("Im updating");</script>';
    $query =   mysqli_query($con,"SELECT answerer_display_name from answers where answer_id='$answer_id'");
    $answerer = mysqli_fetch_assoc($query);
    //$name = $answerer['answer_display_name'];
    $delete_response = mysqli_query($con,"DELETE FROM answers WHERE answer_id = '$answer_id'");
    mysqli_query($con,"UPDATE users SET points=points-1 WHERE display_name='".$answerer['answerer_display_name']."'");

  }
}

?>



