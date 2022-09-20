<?php
    session_start();
    include("connect.php");
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    if(($start==0)||($start==1)&&($end==0)||($end==1))
    {
        $start_end = mysqli_query($connect, "UPDATE user SET start='$start', end='$end' WHERE role=0");
        if($start_end)
            echo'<script>
                alert("Values updated!");
                window.location = "../";
                </script>';
        else 
            echo'<script>
                alert("Some error occured!");
                window.location = "../routes/dashboard-admin.php";
                </script>';
    }
    else
        echo'<script>
            alert("Invalid values entered!");
            window.location = "../routes/dashboard-admin.php";
            </script>';
?>