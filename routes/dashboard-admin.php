<?php
    session_start();
    if(!isset($_SESSION['userdata']))
        header("location: ../routes/admin.html");
    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];
?>

<html>
    <head>
        <title>Easy-Vote - Admin Space</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
        <link rel="stylesheet" href="../css/stylesheet-dash.css">
    </head>

    <body style="background-image: url('../regi_vote.jpg'); background-repeat: no-repeat; background-size: cover;">
        <div id="mainSection">
            <div id="headerSection">
                <a href="../"><button id="backbtn">Home</button></a>
                <a href="admin.html"><button id="logoutbtn">Logout</button></a>
                <center><h1><b>WELCOME ADMINISTRATOR</b></h1></center>
            </div>

            <div id="mainpanel">
                <div id="Profile">
                    <center><b>START / END VOTING</b><hr><br>
                    Current Status<br><br>
                    <b>Start: <?php echo $userdata['start']?></b><br>
                    <b>End: <?php echo $userdata['end']?></b><br><br><br><br>

                    <form action="../api/startendvotes.php" method="POST">
                        <input id="frminp2" type="number" name="start" placeholder="Set START value:" required><br>
                        <input id="frminp2" type="number" name="end" placeholder="Set END value:" required><br>
                        <button id="submitloginbtn" type="submit">SAVE</button></form></center>
                    </form>
                    <center><a href="http://localhost/phpmyadmin/index.php?route=/sql&server=1&db=voting&table=user&pos=0">CHECK VOTER LIST</a></center>
                </div>
       
                <div id="Group">
                    <center><b>NOMINATE / REJECT CANDIDATES</b></center><hr>
                    <?php                
                        if($_SESSION['groupsdata'])
                        {
                            for($i=0;$i<count($groupsdata);$i++)
                            {
                    ?>
                                <div id = groupview>
                                    <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photogrp']?>" height="150" width="140">
                                    <img style="float: left" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" height="150" width="150">
                                    <center>
                                        <b>Group: </b><?php echo $groupsdata[$i]['father']?><br>
                                        <b>Candidate: </b><?php echo $groupsdata[$i]['name']?><br>
                                        <b>Status: </b>
                                        <?php
                                            if($groupsdata[$i]['status']==0)
                                                echo 'NOT NOMINATED';
                                            else
                                                echo 'NOMINATED';
                                        ?><br>
                                        <form action="../api/nominate.php" method="POST">
                                            <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                                            <?php
                                                if($groupsdata[$i]['status']==0)
                                                {
                                            ?>
                                                    <input id="votebtn" type="submit" name="votebtn" value="NOMINATE">
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                                    <input id="denominate" type="submit" name="votebtn" value="DENOMINATE">
                                            <?php
                                                }
                                            ?>
                                        </form>
                                    </center>
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