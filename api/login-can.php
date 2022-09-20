<?php
include("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];

$check = mysqli_query($connect,"SELECT * FROM user WHERE mobile = '$mobile' AND role = 2 ") ;
$checkpass = mysqli_query($connect,"SELECT * FROM user WHERE password = '$password'") ;

$admin = mysqli_query($connect, "SELECT * FROM user WHERE role = 0");
$admindata = mysqli_fetch_array($admin, MYSQLI_ASSOC);

if($admindata['end']==0)
{
    if(mysqli_num_rows($check)>0)
    {
        if(mysqli_num_rows($checkpass)!=0)
        {
            $userdata = mysqli_fetch_array($check);
            if($userdata['status']==1)
            {
                echo'<script>
                alert("You are Nominated");
                window.location = "../";
                </script>';
            }
            else
            {
                echo'<script>
                alert("You are NOT Nominated");
                window.location = "../";
                </script>';
            }                 
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
        window.location = "../routes/login-can.html";
        </script>';
    }
}
else
{
    echo'<script>
        alert("The vote has already ended. You cannot check your status now!");
        window.location = "../";
        </script>';
}
?>