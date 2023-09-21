<?php
include "mysqlconnect.php";
$display_name = $_POST["display_name"];
$Email= $_POST["Email"];
$Password = MD5($_POST["Password"]);
$cPassword = MD5($_POST["cPassword"]);
$country = $_POST["Countries"];


if($cPassword==$Password)
{
	//$con=mysqli_connect("localhost","root","root","quora") or die(mysqli_error($con));
    //print($con);
    if (filter_var($Email, FILTER_VALIDATE_EMAIL))
    {
       
           
          
    
    if($stmt= $con->prepare("INSERT INTO users (display_name, passcode,country,emailhash) VALUES (?,?,?,?)"))
    {
    $stmt->bind_param("ssss",$display_name,$Password,$country,$Email);
    //$stmt->execute();
	//$sql = "INSERT INTO users (duspla, email, password) VALUES ('$Name','$Email',MD5('$Password'))";
	if ($stmt->execute()) {
      header("location: login.php?success=1"); //New record created successfully!
  }

  
}

    }
    else
    {
        header("location: login.php?error=4");
    }
}
else
    header("location: login.php?error=3"); //Password mismatch

?>
