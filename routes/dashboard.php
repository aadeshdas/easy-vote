<?php
    session_start();
    if(!isset($_SESSION['userdata']))
        header("location: ../routes/login.html");

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0)
        $status = '<b style="color:red">NOT VOTED</b>';
    else
        $status = '<b style="color:green">VOTED</b>';
?>

<html>
    <head>
        <title>Easy-Vote - Dashboard</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
        <link rel="stylesheet" href="../css/stylesheet-dash.css">
    </head>

    <body style="background-image: url('../regi_vote.jpg'); background-repeat: no-repeat; background-size: cover;">
        <div id="mainSection">
            
            <div id="headerSection">
                <a href="../"><button id="backbtn">Home</button></a>
                <a href="logout.php"><button id="logoutbtn">Logout</button></a>
                <center><h1><b>WELCOME <?php echo $userdata['name']?></b></h1></center>
            </div>

            <div id="mainpanel">
                <div id="Profile">
                    <center><b>PROFILE</b><hr>
                    <img src="../uploads/<?php echo $userdata['photo']?>" height="125" width="120"></center><br>
                    <div id="votestatus">
                        <center><?php echo $status?></center>
                    </div><br>
                    <b>Name: <?php echo $userdata['name']?><br><br></b>
                    <b>Father/Husband: </b><?php echo $userdata['father']?><br><br>
                    <b>Age: </b><?php echo $userdata['age']?> ( <?php echo $userdata['gender']?> )<br><br>
                    <b>Mobile: </b><?php echo $userdata['mobile']?><br><br>
                    <b>Address: </b><?php echo $userdata['address']?>, 
                    <?php echo $userdata['state']?>, 
                    <?php echo $userdata['pincode']?><br>
                </div>
       
                <div id="Group">
                    <center><b>GROUPS</b></center><hr>
                    <?php
                        if($_SESSION['groupsdata'])
                        {
                            for($i=0;$i<count($groupsdata);$i++)
                            {
                    ?> 
                                <div id = groupview>
                                    <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photogrp']?>" height="150" width="140">
                                    <img style="float: left" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" height="150" width="150">
                                    <div><center>
                                        <b>Group: </b><?php echo $groupsdata[$i]['father']?><br>
                                        <b>Candidate: </b><?php echo $groupsdata[$i]['name']?><br><br>
                                        <form action="../api/vote.php" method="POST">
                                            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                                            <?php
                                                if($_SESSION['userdata']['status']==0)
                                                {
                                            ?>
                                                    <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                                    <?php
                                                }
                                                    ?>
                                        </form>
                                    </div></center>
                                </div>
                    <?php       
                            }                    
                        }
                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>