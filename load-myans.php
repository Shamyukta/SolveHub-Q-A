<?php
session_start();
include "mysqlconnect.php";
//$con = $con=mysqli_connect("localhost","jith","Abhinav1234","quora") or die(mysqli_error($con));
$user = $_SESSION['user'];

$query = "SELECT distinct(a.question_id) as qid,q.questioner_display_name as qname,q.title as title FROM answers as a,questions as q WHERE a.question_id = q.question_id and a.answerer_display_name=?";
$stmt = $con->prepare($query);	
$stmt->bind_param("s", $user);
$stmt->execute();
$select_query = $stmt->get_result();

//$select_query=mysqli_query($con,"SELECT a.question_id as qid,q.questioner_display_name as qname,q.title as title FROM answers as a,questions as q WHERE a.question_id = q.question_id and a.answerer_display_name='$user'");
$i = 1;

if(!isset($_GET['qby']))
{
	while($result = $select_query->fetch_assoc())
	{
		$qby=$result['qname'];
		$q=$result['qid'];
		$q_title = $result["title"];

		$query = "SELECT COUNT(*) AS num FROM answers WHERE question_id=?";
		$stmt = $con->prepare($query);	
		$stmt->bind_param("s", $q);
		$stmt->execute();
		$response_query = $stmt->get_result();
		
		//$response_query = mysqli_query($con,"SELECT COUNT(*) AS num FROM answers WHERE question_id='$q' ");
		$responses=$response_query->fetch_assoc();

		?><script type="text/javascript">console.log(<?php echo $responses['num'];?>);</script><?php
		$output = ""; 
		$output .= "<div class='entry'><h2 class='username' style='color: orange;'><span class='glyphicon glyphicon-user'></span> ".$qby."</h2><input id='q_by".$i."' style='display: none;' value='".$qby."'><div class='container'>";
		$output .= "<h3 id='qlink".$i."'><a class='qlink' href='qlinks.php?qby=".$qby."&qid=".$q."'>".$q_title."</a>";
		//$output .= "<h3 id='qlink".$i."'><a class='qlink' href='qlinks.php?q=".$q_title."&qby=".$qby."'>".$q_title."</a>";
		$output .= "</h3><input id='q".$i."' style='display: none;' value='".$q_title."'>";
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

	if(!isset($_GET['qby']))
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
				var response_to_question = $("#q"+<?php echo $k; ?>).val();
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
					data: {response: response,response_to_user: response_to_user,response_to_question: response_to_question,flag: flag},
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