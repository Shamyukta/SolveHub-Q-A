<?php
session_start();
include "mysqlconnect.php";
$q_title = $_POST['ques_title'];
$q_body = $_POST['ques_body'];
$q_tags=[];
if(isset($_POST['tags']))
{
$q_tags = $_POST['tags'];
}
$qby = $_SESSION['user'];
//echo '<script type="text/javascript">alert("'.$q_tags[0].'");</script>';
if($q_title != "" && $q_body!="")
    {
	$query = "INSERT INTO questions(questioner_display_name,posted_datetime,title,body) VALUES(?,current_time(),?,?)"; 
	$stmt = $con->prepare($query);	
	$stmt->bind_param("sss", $qby, $q_title, $q_body);
	$stmt->execute();
	if(!empty($q_tags))
	{
      foreach($q_tags as $tag)
	  {   //echo '<script type="text/javascript">alert("'.$tag.'");</script>';
		  $insert_question_tag = "INSERT INTO question_topic_mapping(subtopic_id,question_id) VALUES(?,last_insert_id())"; 
		  $stmt = $con->prepare($insert_question_tag);	
	      $stmt->bind_param("s", $tag);
	      $stmt->execute();
	  }
	}
}
mysqli_query($con,"UPDATE users SET points=points+1 WHERE display_name='$qby'") or die(mysqli_error($con));

?>
