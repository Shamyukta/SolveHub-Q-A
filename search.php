<?php

session_start();
include 'mysqlconnect.php';
$user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <style type="text/css">
 body{
  background-color: #1a1a1a;
  color: #ff0000;
}
.hide{
  display: none;
}


.heading{ 
  font-size: 50px;
  position: relative;
  left: 600px;
}

.headingContainer{
  border-bottom: 1px solid #ff0000;
}

.logout-btn{
  font-size: 20px;
  position: relative;
  top: 1px;
  left: 515px;
  background-color: red;
  color: white;
  border:none;
  padding-bottom: 5px;
  float:right;
}

.logout-btn:hover{
  color: black;
}

b{
  color: #ff0000;
}
.ask{
  border-radius: 2px;
  background-color: red;
  color: white;
  border: none;
}
.ask:hover{
  color: black;
}

.bodyContainer{
  padding-left: 75px;
  padding-right: 75px;
}
.empty{
  height: 150px;
}
.hidden-div{
  color: white;
}
.username{
  color: red;
}
.subtext{
  font-size: 10px;
  padding-left: 10px;
}
.container{
  color: white;
}
.entry{
  border-bottom: 1px solid red;
}
.ans-btn,.submit-ans,.logout{
  border-radius: 2px;
  background-color: red;
  color: white;
  border: none;
}

.ans-btn:hover,.submit-ans:hover,.logout:hover{
  color: black;
}
.ans-field{
  display: none;
  color: black;
}
.submit-ans{
  display: none;
}

.small{
  background-color: #1a1a1a;
  color: white;
  font-size: 10px;
  border:none;
}
.qlink{
  color: white;
}

.small:hover,.qlink:hover{
  text-decoration: underline;
  cursor: pointer;
  color: white;
}
.yellow{
  width: 50px;
  height: 50px;
  background-color: yellow;
}
.navbar-default{
  background-color: black;
  border-color: red;
  color: red;
  background-color: black;
}

.logout{
  float: right;
}
.search,.btn-primary{
  border-radius: 2px;
  float: right;
}
.search{
  width: 275px;
}

</style>
</head>
<body>

  <b style="color: orange;"><?php

  if(isset($_SESSION['user']))
  {  
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
          <input type="text" class="search" name="srch" placeholder="Search for a question">
        </div>
      </form>
    </div>
  </nav>

  <button class='logout' id='logout'><span class="glyphicon glyphicon-log-out"></span>Logout</button><br><br>



  <?php if(isset($_POST['srchbtn']))
  {
   $search = mysqli_real_escape_string($con,$_POST['srch']);
   $search = $search."*";
   $search_query = "select M.question_id as question_id,M.title as title,M.questioner_display_name as qname from 
   (select question_id,A.title,SUM(A.total_ranking) as overall_ranking from
   (with overall_join as 
   (select * from 
   (with question_relevance_calculation as
   (SELECT question_id,title,body, MATCH (title,body)
           AGAINST ('$search' IN BOOLEAN MODE) as ques_relevance from questions) select *, RANK() OVER(ORDER BY ques_relevance asc)AS ques_ranking from question_relevance_calculation where ques_relevance>0) as X LEFT JOIN 
    (with answer_relevance_calculation as     
          ( SELECT question_id as q,answer_id,answer_text, MATCH (answer_text)
           AGAINST ('$search' IN BOOLEAN MODE) as ans_relevance from answers) select *, RANK() OVER(ORDER BY ans_relevance asc)AS ans_ranking from answer_relevance_calculation where ans_relevance>0) as Y ON X.question_id = Y.q
           UNION
   select q as question_id,title,body,ques_relevance,ques_ranking,q,answer_id,answer_text,ans_relevance,ans_ranking from 
   (with question_relevance_calculation as
   (SELECT question_id,title,body, MATCH (title,body)
           AGAINST ('$search' IN BOOLEAN MODE) as ques_relevance from questions) select *, RANK() OVER(ORDER BY ques_relevance asc)AS ques_ranking from question_relevance_calculation where ques_relevance>0) as X RIGHT JOIN 
    (with answer_relevance_calculation as     
          ( SELECT question_id as q,answer_id,answer_text, MATCH (answer_text)
           AGAINST ('$search' IN BOOLEAN MODE) as ans_relevance from answers) 
           select *, RANK() OVER(ORDER BY ans_relevance asc)AS ans_ranking from answer_relevance_calculation where ans_relevance>0) as Y ON X.question_id = Y.q) select question_id,title,body,answer_text, (coalesce(ques_ranking,0)+(0.1 * coalesce(ans_ranking,0))) as total_ranking from overall_join group by question_id) as A group by A.question_id) as N,questions as M where M.question_id=N.question_id order by N.overall_ranking desc";
   $get_search = mysqli_query($con,$search_query);
   $search_result_rows = mysqli_num_rows($get_search);

   if($search_result_rows > 0)
   {
   	$i = 0;
   	$output = "";
   	$output .= "<div class='bodyContainer'><div style='border-bottom: 1px solid white;'><b>".$search_result_rows." Results found</b></div>";
   	
     while($row = mysqli_fetch_assoc($get_search))
     {
     	$i += 1;
     	$qby = $row['qname'];
      $q = $row['question_id'];
      $response_query = mysqli_query($con,"SELECT COUNT(*) AS num FROM answers WHERE question_id='$q' ");
      $responses=mysqli_fetch_assoc($response_query);
      
      
      $output .= "<div class='entry'><h2 class='username' style='color: orange;'><span class='glyphicon glyphicon-user'></span> ".$row['qname']."</h2><input id='q_by".$i."' style='display: none;' value='".$row['qname']."'><div class='container'>";
      
      $output .= "<h3 id='qlink".$i."'><a class='qlink' href='qlinks.php?q=".$row['title']."&qby=".$row['qname']."&qid=".$q."'>".$row['title']."</a>";
      
      $output .= "</h3><input id='q".$i."' style='display: none;' value='".$row['title']."'>";
      
      $output .= "<button id='ansBtn".$i."' class='ans-btn'><span class='glyphicon glyphicon-pencil'></span>Answer</button>";
      
      $output .= "<div class='small'>(".$responses['num'].")Answers</div>";
      
      $output .= "<textarea name='ans' class='ans-field' id='inpAns".$i."'></textarea><button type='submit' class='submit-ans' id='submitAns".$i."'>Submit</button></div><br><div id='success'></div></div>";
      
      
      
    }
  }
  else if($search_result_rows == 0 && isset($_POST['srch']))
  {
    $output = "<p>No results matching your search</p>";
  }
}
echo $output;
?>










<?php } ?>
<script type="text/javascript">
	//var flag = 0;
	function logout()
	{
		window.location = "login.php";
	}


  <?php for($k = 1;$k <= $i;$k++) { ?>

    document.getElementById("ansBtn"+<?php echo $k; ?>).onclick=function()
    {
     
      var ansBtn = document.getElementById("ansBtn"+<?php echo $k; ?>);
      ansBtn.style.display = "none";
      var inpAns = document.getElementById("inpAns"+<?php echo $k; ?>);
      inpAns.style.display = "block";
      var submitAnsBtn = document.getElementById("submitAns"+<?php echo $k; ?>);
      submitAnsBtn.style.display = "block";
      
      
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

  <?php } ?>

</script>
</body>
</html>
