<!DOCTYPE html>
<html>
<head>
    <title>lol</title>
</head>
<body>
    <?php
    include "mysqlconnect.php";
    
    //$con=mysqli_connect("localhost","root","root","stackoverflow")
    //or die(mysqli_error($con));
    $id=$_POST['display_name'];
    $pwd=$_POST['lpassword'];
    $datau=mysqli_query($con,"SELECT COUNT(*) AS num FROM users WHERE display_name='$id'") ;
    $row = mysqli_fetch_assoc($datau);

    if($row['num'] != 0)
    {
        
        $datap=mysqli_query($con,"SELECT passcode FROM users WHERE display_name='$id'");
        $result=mysqli_fetch_assoc($datap);

        if($result['passcode'] == md5($pwd))
        {
            $username_query=mysqli_query($con,"SELECT display_name FROM users WHERE display_name='$id'");
            $username=mysqli_fetch_assoc($username_query);
            session_start();
            $_SESSION['user']=$username['display_name'];
            header("location: homepage.php");
        }
        else
        {
                header("location: login.php?error=1"); //Invalid password 
            }
        }
        else
        {
        header("location: login.php?error=2"); // Invalid email
    }
    ?>

</body>
</html>