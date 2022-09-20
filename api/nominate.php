<?php
    session_start();
    include('connect.php');
    $gid = $_POST['gid'];
    $votebtn = $_POST['votebtn'];
    
    if($votebtn=="NOMINATE")
        $newstatus=1;
    if($votebtn=="DENOMINATE")
        $newstatus=0;

    $update_nominate_status = mysqli_query($connect, "UPDATE user SET status='$newstatus' WHERE id='$gid'");

    if($update_nominate_status)
    {
        $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    
        $_SESSION['groupsdata'] = $groupsdata;
        echo'<script>
            window.location = "../routes/dashboard-admin.php";
            </script>';

    }
    else{
        echo'<script>
            alert("Some error occured!");
            window.location = "../routes/dashboard-admin.php";
            </script>';
    }
    ?>