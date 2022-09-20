<?php
    include("../api/connect.php");
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2 AND status = 1 ORDER BY votes DESC");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $groupvote = mysqli_query($connect, "SELECT father, votes FROM user WHERE role = 2 AND status = 1 ORDER BY votes DESC");

    $admin = mysqli_query($connect, "SELECT * FROM user WHERE role = 0");
    $admindata = mysqli_fetch_array($admin, MYSQLI_ASSOC);
?>

<html>
    <head>
        <title>Easy-Vote - Result</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
        <link rel="stylesheet" href="../css/stylesheet-dash.css">
    </head>

    <body style="background-image: url('../regi_vote.jpg'); background-repeat: no-repeat; background-size: cover;">
        <div id="mainSection">
            <div id="headerSection">
                <a href="../"><button id="logoutbtn">Login Page</button></a>
                <h1>
                    <?php
                    if(($admindata['start']==0)&&($admindata['end']==0))
                    {?>
                        <b> THE VOTE HAS NOT YET STARTED </b> 
                        <?php                      
                    }
                    elseif(($admindata['start']==1)&&($admindata['end']==0))
                    {                        
                    ?>  
                    <?php $a = $groupsdata[0]['votes'] - $groupsdata[1]['votes'];?>                  
                    <b><?php echo $groupsdata[0]['father']?> IS CURRENTLY LEADING BY <?php echo $a ?> VOTE(S)</b>
                    <?php
                    }
                    else
                    {
                        ?>
                        <?php $a = $groupsdata[0]['votes'] - $groupsdata[1]['votes'];?>                  
                        <b><?php echo $groupsdata[0]['father']?> WON BY <?php echo $a ?> VOTE(S)</b>
                        <?php
                    }
                    ?>
                </h1>
            </div>

            <div id="mainpanel">
                <div id="Group-res">
                <?php    
                if(($admindata['start']==1)&&($admindata['end']==0))
                {
                    ?><center><b>GROUPS<b></center><hr>
                    <?php
                    for($i=0;$i<count($groupsdata);$i++)
                    { 
                ?>
                            <div id="resview">
                                <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" height="100" width="100">
                                <b>Group: <?php echo $groupsdata[$i]['father']?><br></b>
                                <b>Candidate: </b><?php echo $groupsdata[$i]['name']?><br><br>
                                <div style="color: green; font-size: 25px">
                                    <b>Votes: <?php echo $groupsdata[$i]['votes']?></b><br>
                                </div>
                            </div>
                    <?php
                    }
                }
                if(($admindata['start']==1)&&($admindata['end']==1))
                {
                    ?>
                    <center>WINNER<hr>
                    <img src="../uploads/<?php echo $groupsdata[0]['photo']?>" height="125" width="120"></center><br>
                    <b>Name: <?php echo $groupsdata[0]['name']?><br><br></b>
                    <b>Group: </b><?php echo $groupsdata[0]['father']?><br><br>
                    <b>Age: </b><?php echo $groupsdata[0]['age']?> ( <?php echo $groupsdata[0]['gender']?> )<br><br>
                    <b>Mobile: </b><?php echo $groupsdata[0]['mobile']?><br><br>
                    <b>Address: </b><?php echo $groupsdata[0]['address']?>, 
                    <?php echo $groupsdata[0]['state']?>, 
                    <?php echo $groupsdata[0]['pincode']?><br>
                    <?php
                }                
                    ?>
                </div>

                <div id="Profile-res">
                    <center>CURRENT VOTE STATUS</center><hr>
                    <?php
                    if($admindata['start']==1)
                    {
                    ?>
                        <div id="piechart"></div>
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['barchart']});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart()
                            {
                                var data = google.visualization.arrayToDataTable([
                                    ['Group','Votes'],
                                    <?php
                                        while($row = mysqli_fetch_array($groupvote))
                                        {
                                            echo"['".$row["father"]."', ".$row["votes"]."],";
                                        }
                                    ?>
                                    ]);

                                var options = {is3D:true};
                                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                chart.draw(data,options);
                            }
                        </script>
                    <?php
                    }
                    ?>
                </div> 
            </div>
        </div>
    </body>
</html> 