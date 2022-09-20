<?php
session_start();
include("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$check = mysqli_query($connect,"SELECT * FROM user WHERE mobile = '$mobile' AND role = 1 ") ;
$checkpass = mysqli_query($connect,"SELECT * FROM user WHERE password = '$password'") ;

$admin = mysqli_query($connect, "SELECT * FROM user WHERE role = 0");
$admindata = mysqli_fetch_array($admin, MYSQLI_ASSOC);

if(($admindata['start']==1) && ($admindata['end']==0))
{
    if(mysqli_num_rows($check)>0)
    {
        if(mysqli_num_rows($checkpass)!=0)
        {
            $userdata = mysqli_fetch_array($check);
            $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2 AND status = 1");
            $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
            $_SESSION['userdata'] = $userdata;
            $_SESSION['groupsdata'] = $groupsdata;

            echo'<script>
                alert("Login Successsful! Click \'OK\' to go to the Dashboard");
                window.location = "../routes/dashboard.php";
                </script>';
        }
        else
        {
            echo'<script>
            alert("Incorrect Password! Click \'OK\' and try again with the correct password");
            window.location = "../routes/login.html";
            </script>';
        }
    }
    else
    {
        echo'<script>
            alert("Invalid Credentials! Check your phone number and try again");
            window.location = "../routes/login.html";
            </script>';
    }
}
elseif($admindata['start']==0)
{
    echo'<script>
        alert("The vote has not yet started. You cannot login now!");
        window.location = "../";
        </script>';
}
else
{
    echo'<script>
        alert("The vote has already ended. You cannot login now!");
        window.location = "../";
        </script>';
}
?>