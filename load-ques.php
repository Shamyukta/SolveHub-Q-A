
<?php
session_start();
include "mysqlconnect.php";

$select_query="SELECT * FROM questions order by posted_datetime desc";
$stmt = $con->prepare($select_query);
$stmt->execute();
$mysqli_result = $stmt->get_result();
$i = 1;

if(!isset($_GET['q']) || !isset($_GET['qby']))
{ //echo "Coming In"
  while($result = $mysqli_result->fetch_assoc())
  {
    $qby=$result['questioner_display_name'];
    $q=$result['question_id'];
    $title = $result['title'];
    $body = $result['body'];

    $s_query = "SELECT COUNT(*) AS num FROM answers WHERE question_id=?";
	  $prepare = $con->prepare($s_query);	
	  $prepare->bind_param("s", $q);
	  $prepare->execute();
    $_result = $prepare->get_result();

    //$response_query = mysqli_query($con,"SELECT COUNT(*) AS num FROM answers WHERE response_to_user='$qby' AND response_to_question='$q' ");
    //$response_query = mysqli_query($con,"");
    //$responses=mysqli_fetch_assoc($response_query);
    $responses=$_result->fetch_assoc();
    ?><script type="text/javascript">console.log(<?php echo $responses['num'];?>);</script><?php
    $output = ""; 
    //$output .= "<div class='entry'><h2 class='username' style='color: orange;'><span class='glyphicon glyphicon-user'></span> ".$result['question_by']."</h2><input id='q_by".$i."' style='display: none;' value='".$result['question_by']."'><div class='container'>";
    $output .= "<div class='entry'><h2 class='username' style='color: orange;'><span class='glyphicon glyphicon-user'></span> ".$result['questioner_display_name']."</h2><input id='q_by".$i."' style='display: none;' value='".$result['questioner_display_name']."'><div class='container'>";
    $output .= "<h3 id='qlink".$i."'><a class='qlink' href='qlinks.php?q=".$result['title']."&qby=".$result['questioner_display_name']."&qid=".$q."'>".$result['title']."</a>";
    //$output .= "<h3 id='qlink".$i."'><a class='qlink' href='qlinks.php?qid=".$q."'>".$result['title']."</a>";
  
    //$output .= "<a href='javascript:myFunction(".$result['title'].")'> Click Me! <a/>";
    //$output .= "<a href='javascript:myFunction('$title', '$body', '$qby', '$q')'> Click Me! <a/>";
    $output .= "</h3><input id='q".$i."' style='display: none;' value='".$q."'>";
    $output .= "<button id='ansBtn".$i."' class='ans-btn'><span class='glyphicon glyphicon-pencil'></span>Answer</button>";
    $output .= "<div class='small'>(".$responses['num'].")Answers</div>";
    $output .= "<textarea name='ans' class='ans-field' id='inpAns".$i."'></textarea><button type='submit' class='submit-ans' id='submitAns".$i."'>Submit</button></div><br><div id='success'></div></div>";
    echo $output;
    $i += 1;
    
  }
}

?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript"> 
  var flag = 0;


  <?php 

  if(!isset($_GET['q']) || !isset($_GET['qby']))
  { 
   for($k = 1;$k <= $i;$k++) { ?>

    document.getElementById("ansBtn"+<?php echo $k; ?>).onclick=function()
    {
      if(flag == 0)
      {   
        var ansBtn = document.getElementById("ansBtn"+<?php echo $k; ?>);
        ansBtn.style.display = "none";
        var inpAns = document.getElementById("inpAns"+<?php echo $k; ?>);
        inpAns.style.display = "block";
        var submitAnsBtn = document.getElementById("submitAns"+<?php echo $k; ?>);
        submitAnsBtn.style.display = "block";
        flag = 1;
      }
    };

    document.getElementById("submitAns"+<?php echo $k; ?>).onclick = function()
    {
      var response = $("#inpAns"+<?php echo $k; ?>).val();
      var response_to_user = $("#q_by"+<?php echo $k; ?>).val();
      //alert(response);
      var response_to_question = $("#q"+<?php echo $k; ?>).val();
      //alert(response_to_question);
      var ansBtn = document.getElementById("ansBtn"+<?php echo $k; ?>);
      ansBtn.style.display = "block";
      var inpAns = document.getElementById("inpAns"+<?php echo $k; ?>);
      inpAns.style.display = "none";
      var submitAnsBtn = document.getElementById("submitAns"+<?php echo $k; ?>);
      submitAnsBtn.style.display = "none";
      inpAns.value="";
      flag = 0;


      $.ajax({
        method: "POST",
        url: "inputresponse.php",
        data: {response: response,response_to_question: response_to_question,flag: flag},
        success: function(status) {
          $("#success").text(status);
        }
      });
      location.reload();
    };  

    <?php 
  }
}
?>

</script>
