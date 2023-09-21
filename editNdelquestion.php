<?php
session_start();
include "mysqlconnect.php";


if(isset($_POST['question_id'])){
  $question_id = $_POST['question_id'];
  $qby = $_SESSION['user'];
if(isset($_POST['ques']) && isset($_POST['title']))
    {
      $ques = $_POST['ques'];
      $title = $_POST['title'];

      
      
      $edit_ques = mysqli_query($con,"UPDATE questions SET title = '$title', body = '$ques' WHERE questioner_display_name ='$qby' AND question_id = '$question_id'");
      
    }

   else if(!isset($_POST['ques']) && !isset($_POST['title']))
    {
      
      $del_ques = mysqli_query($con,"DELETE FROM questions WHERE questioner_display_name ='$qby' AND question_id = '$question_id'");
      mysqli_query($con,"UPDATE users SET points=points-1 WHERE display_name='$qby'");
      //header("location: homepage.php");
    }
  }
?>