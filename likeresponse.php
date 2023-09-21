<?php
include "mysqlconnect.php";
session_start();
$user = $_SESSION['user'];
$answer_id = $_POST['answer'];
$vote_type = $_POST['type'];
$query1 = mysqli_query($con,"SELECT COUNT(*) as numvotes FROM votes WHERE voter_display_name='$user' AND answer_id='$answer_id'");

$nvotes = mysqli_fetch_assoc($query1);

if($nvotes['numvotes']==0)
{ 
  $insert_vote=mysqli_query($con,"INSERT INTO votes VALUES('$user','$vote_type','$answer_id',current_time())");
 
}
else
{ 
  $query3 = mysqli_query($con,"SELECT votetype FROM votes WHERE voter_display_name='$user' AND answer_id='$answer_id'");
  $current_vote = mysqli_fetch_assoc($query3);
  if($current_vote['votetype']==$vote_type)
  {
    $delete_vote = mysqli_query($con,"DELETE FROM votes where voter_display_name='$user' AND answer_id='$answer_id'");

  }
  else
  { 
    $update_vote = mysqli_query($con,"UPDATE votes SET votetype='$vote_type' WHERE voter_display_name='$user' AND answer_id='$answer_id'");
  }
}

$answerer_query =  mysqli_query($con,"SELECT answerer_display_name FROM answers WHERE answer_id='$answer_id'");
$answerer = mysqli_fetch_assoc($answerer_query);
if($vote_type == "upvote")
{
 //echo '<script type="text/javascript">alert("'.$answerer['answerer_display_name'].'");</script>';
 if($nvotes['numvotes']==0 || $current_vote['votetype']!=$vote_type)
 {
 mysqli_query($con,"UPDATE users SET points=points+2 WHERE display_name='".$answerer['answerer_display_name']."'");
 }
 else
 {
  mysqli_query($con,"UPDATE users SET points=points-2 WHERE display_name='".$answerer['answerer_display_name']."'");
 }
}
else if($vote_type=="downvote")
{
if($nvotes['numvotes']==0 || $current_vote['votetype']!=$vote_type)
{
 mysqli_query($con,"UPDATE users SET points=CASE WHEN points >=0.5 THEN points-0.5 END WHERE display_name='".$answerer['answerer_display_name']."'");
}
else
{
  mysqli_query($con,"UPDATE users SET points= points+0.5 WHERE display_name='".$answerer['answerer_display_name']."'");
}
   //echo '<script type="text/javascript">alert("'.$answerer['name'].'");</script>';

}
else
{
 //$update_points=mysqli_query($con,"UPDATE users SET points=CASE WHEN points>=1 THEN points-1 END WHERE display_name='$answerer['name']'") or die(mysqli_error($con));
 if($nvotes['numvotes']==0 || $current_vote['votetype']!=$vote_type)
 {
 mysqli_query($con,"UPDATE users SET points=CASE WHEN points>=1 THEN points-1 END WHERE display_name='".$answerer['answerer_display_name']."'") or die(mysqli_error($con));
}
else
{
  mysqli_query($con,"UPDATE users SET points=points+1 WHERE display_name='".$answerer['answerer_display_name']."'") or die(mysqli_error($con));
}
}

?>
