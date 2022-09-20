<?php
session_start();
include("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$check = mysqli_query($connect,"SELECT * FROM user WHERE mobile = '$mobile' AND password = '$password' AND role = 0") ;

if(mysqli_num_rows($check) > 0)
{
    $userdata = mysqli_fetch_array($check);
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    /*$voters = mysqli_query($connect, "SELECT * FROM user WHERE role = 1");
    $voterssdata = mysqli_fetch_all($voters, MYSQLI_ASSOC);*/

    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;

    echo'<script>
        alert("Login Successful!");
        window.location = "../routes/dashboard-admin.php";
        </script>';
}
else
{
    echo'<script>
        alert("Invalid Credentials!");
        window.location = "../";
        </script>';
}
?>