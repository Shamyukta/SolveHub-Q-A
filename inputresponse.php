  <?php

  session_start();
  include "mysqlconnect.php";
  //echo '<script type="text/javascript">alert("'.isset($_POST['flag']).'");</script>';
  //$con = mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
  if(isset($_POST['flag']))
  {
   $response = $_POST['response'];
   $response_by = $_SESSION['user'];
   //$response_to_user = $_POST['response_to_user'];
   $response_to_question = $_POST['response_to_question'];

   if($response != "")
   {
     //$insert_response = mysqli_query($con,"INSERT INTO response (response,response_to_question,response_to_user,response_by) VALUES('$response','$response_to_question','$response_to_user','$response_by')");
     $query = "INSERT INTO answers(answerer_display_name,question_id,posted_datetime,answer_text) VALUES(?,?,current_time(),?)";
	   $stmt = $con->prepare($query);	
	   $stmt->bind_param("sss", $response_by, $response_to_question, $response);
	   $stmt->execute();
   }
 }
 //echo ".isset($_POST['flag']).";
 
 else if(!isset($_POST['flag']))
 {  
   if(isset($_SESSION['qid']))
   {
     $response = $_POST['response'];
     $response_by = $_SESSION['user'];
     $response_to_question = $_SESSION['qid'];
     if($response != "")
     {
      $insert_response = mysqli_query($con,"INSERT INTO answers(answerer_display_name,question_id,posted_datetime,answer_text) VALUES('$response_by','$response_to_question',current_time(),'$response')");
      
    }
  }
}  
mysqli_query($con,"UPDATE users SET points=points+1 WHERE display_name='$response_by'") or die(mysqli_error($con));
?>



