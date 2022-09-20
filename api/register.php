<?php
include("connect.php");

$name = $_POST['name'];
$id = $_POST['id'];
$mobile = $_POST['mobile'];
$father = $_POST['father'];
$gendernum = $_POST['gender'];
$age = $_POST['age'];
$address = $_POST['address'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$photo = $_FILES['photo']['name'];
$size= $_FILES['photo']['size'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = 1;

$idcheck = mysqli_query($connect,"SELECT id FROM user WHERE id='$id'");
$countid = mysqli_num_rows($idcheck);

$mobilenum = mysqli_query($connect,"SELECT mobile FROM user WHERE mobile='$mobile'");
$count = mysqli_num_rows($mobilenum);

if($gendernum==2)
    $gender="Male";
if($gendernum==3)
    $gender="Female";
if($gendernum==4)
    $gender="Others";

$admin = mysqli_query($connect, "SELECT * FROM user WHERE role = 0");
$admindata = mysqli_fetch_array($admin, MYSQLI_ASSOC);

if(($admindata['start']==0) && ($admindata['end']==0))
{
    if($countid==0)
    {
        if($age>17)
        {
            if(($size>0) && ($size<=1048600))
            {
                if($password==$cpassword)
                {
                    if($mobile>=6000000000 && $mobile<=9999999999)
                    {
                        if($count==0)
                        {
                            if($pincode>=100000 && $pincode<=999999)
                            {
                                move_uploaded_file($tmp_name,"../uploads/$photo");
                                $insert = mysqli_query($connect,"INSERT INTO user (id, name, mobile, father, gender, age, address, state, pincode, password, photo, role, status, votes)VALUES('$id', '$name', '$mobile', '$father', '$gender','$age', '$address','$state', '$pincode', '$password', '$photo', '$role', 0, 0 )");
                                if($insert)
                                {
                                    echo'<script>
                                        alert("Registration Successful! Click \'OK\' to go to the Homepage");
                                        window.location = "../";
                                        </script>';
                                }
                                else
                                {
                                    echo'<script>
                                        alert("Some error occured! Please try after some time...");
                                        window.location = "../routes/register.html";
                                        </script>';
                                }
                            }
                            else
                            {
                            echo'<script>
                                alert("Invalid Pincode entered!");
                                window.location = "../routes/register.html";
                                </script>';
                            }
                        }
                        else
                        {
                        echo'<script>
                            alert("Mobile number already registered! Click \'OK\' to go to the Login Page");
                            window.location = "../routes/login.html";
                            </script>';
                        }
                        
                    }
                    else
                    {
                        echo'<script>
                            alert("Invalid Mobile Number!");
                            window.location = "../routes/register.html";
                            </script>';
                    }    
                }
                else{
                    echo'<script>
                        alert("Password and Confirm Password does not match!");
                        window.location = "../routes/register.html";
                        </script>';
                }
            }
            else
            {
                echo'<script>
                        alert("Image size must be less than 1MB!");
                        window.location = "../routes/register.html";
                        </script>';
            }
        }
        else
        {
            echo'<script>
                alert("INAPPROPRIATE AGE! Minimum age requirement is 18 years.");
                window.location = "../";
                </script>';
        }
    }
    else
    {
        echo'<script>
            alert("You cannot register twice with the same UID.");
            window.location = "../";
            </script>';    
    }
}
elseif(($admindata['start']==1) && ($admindata['end']==0))
{
    echo'<script>
        alert("The vote has already started. You cannot register now!");
        window.location = "../";
        </script>';
}
else
{
    echo'<script>
        alert("The vote has already ended. You cannot register now!");
        window.location = "../";
        </script>';
}
?>