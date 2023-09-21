<?php
include "mysqlconnect.php";
session_start();

$answer_id = $_POST['answer'];


$query3 = mysqli_query($con,"SELECT answerer_display_name FROM answers WHERE answer_id='$answer_id'");
$answerer = mysqli_fetch_assoc($query3);
$query = mysqli_query($con,"SELECT question_id from answers where answer_id='$answer_id'");
$current_vote = mysqli_fetch_assoc($query);
$question_id = $current_vote['question_id'];
$query1 =   mysqli_query($con,"SELECT count(*) as count from answers where question_id='$question_id' and is_best=1");
$best_count = mysqli_fetch_assoc($query1);
if(isset($_POST['is_best']) && $_POST['is_best']==1)
{   $is_best = 1;
    if($best_count['count']==0)
    {
    $query1 = mysqli_query($con,"UPDATE answers SET is_best='$is_best' WHERE answer_id='$answer_id'");
    mysqli_query($con,"UPDATE users SET points=points+10 WHERE display_name='".$answerer['answerer_display_name']."'") or die(mysqli_error($con));
    }
    else
    {
      
        echo '<script type="text/javascript">alert("There can be only one best answer per question");</script>';
        //echo "There can be only one best answer per question";
      
        
    }
}    
else if(isset($_POST['is_best']) && $_POST['is_best']==0)
{   $is_best=0;
    $query = mysqli_query($con,"UPDATE answers SET is_best='$is_best' WHERE answer_id='$answer_id'");
    mysqli_query($con,"UPDATE users SET points=points-10 WHERE display_name='".$answerer['answerer_display_name']."'") or die(mysqli_error($con));
}

else if(isset($_POST['is_accepted']) && isset($_POST['answer']))
{ 
 $is_accepted = $_POST['is_accepted'];   
$query2 = mysqli_query($con,"UPDATE answers SET is_accepted='$is_accepted' WHERE answer_id='$answer_id'");
if($is_accepted==1)
{
    mysqli_query($con,"UPDATE users SET points=points+5 WHERE display_name='".$answerer['answerer_display_name']."'") or die(mysqli_error($con));
}
else
{
    mysqli_query($con,"UPDATE users SET points=points-5 WHERE display_name='".$answerer['answerer_display_name']."'") or die(mysqli_error($con));
}

}

?>
