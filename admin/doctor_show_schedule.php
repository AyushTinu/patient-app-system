<?php 
session_start();?>

<html>
<head>
	<title>show doctor schedule</title>
    <style>
        table,td,th{
            border: 1px solid black;
        }
        form{
            font-family: monospace;
        }
    </style>
</head>
<body>
	<form action="doctor_show_schedule.php" method="post">
       <h2>Shows a table of all the doctors with there schedule</h2>
        <table>
           <?php

if(isset($_POST['returnadmin'])){
    header("Refresh:1; url=mainpage.php");
    echo "loading please wait";
}

        echo "<tr>";
            echo "<th>CID</th>";
            echo "<th>Clinic name</th>";
            echo "<th>DID</th>";
            echo "<th>Doctor Name</th>";
            echo "<th>Day available</th>";
            echo "<th>Time</th>";
        echo "</tr>";
            
            include 'admin_dbcon.php';

            $sel1 = $db_host->prepare("select * from doctor_availability order by did, cid asc");
            $sel1->execute();
            
            while($row1 = $sel1->fetch()){
                //this loop is for fetching cid, did, day, start and end time form doctor_availablity table
                $sel2 = $db_host->prepare("select * from doctor_account where did = :did");
                $sel2->bindValue(':did', $row1['did']);
                $sel2->execute();
            
                while($row2 = $sel2->fetch()){
                    //this loop is for fetching doctor name form doctor_account table
                    $sel3 = $db_host->prepare("select * from clinic where cid = :cid");
                    $sel3->bindValue(":cid", $row1['cid']);
                    $sel3->execute();
                    
                    while($row3 = $sel3->fetch()){
                        //this loop is for fetching the clinic name form clinic table
                        echo "<tr>";
                            echo "<td>".$row1['cid']."</td>";
                            echo "<td>".$row3['clinic_name']."</td>";
                            echo "<td>".$row1['did']."</td>";
                            echo "<td>".$row2['doctor_name']."</td>";
                            echo "<td>".$row1['day']."</td>";
                            echo "<td>".$row1['start_time']." - ".$row1['end_time']."</td>";
                        echo "</tr>";
                    }
                }
            }
            unset($db->host);

            ?>
        </table>
        <button name="returnadmin"><b>Return to admin page</b></button>
	</form>
	
</body>
</html>


