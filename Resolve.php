<?php
session_start();
include "mysqlconnect.php";


if(isset($_POST['question_id'])){
if($_POST['flag'] == 1)
    {
      $question_id = $_POST['question_id'];

      //echo '<script type="text/javascript">alert("Im updating");</script>';
      $edit_ques = mysqli_query($con,"UPDATE questions SET question_status = 'resolved', resolved_datetime = current_time()");
      
    }

    if($_POST['flag'] == 0)
    {
      //$qby = $_SESSION['user'];
      //echo '<script type="text/javascript">alert("Im deleting");</script>';
      $edit_ques = mysqli_query($con,"UPDATE questions SET question_status = 'unresolved', resolved_datetime = current_time()");
      
    }
  }
?>