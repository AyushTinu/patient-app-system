<html>
<head>
	<title>Doctor show</title>
	<style>
        table,td,tr{
            border: 1px solid black;
            border-collapse: collapse;
        }
        form{
            font-family: verdana;
            border: 1px solid black;
        }
    </style>
</head>
<body>
	<form action="doctor_show.php" method="post">
	    <h2>Show all the assigned doctors</h2>
	    <?php
        session_start();

        if(isset($_POST['returnadmin'])){
            header("Refresh:1; url=mainpage.php");
            echo "loading please wait";
        }

        include 'admin_dbcon.php';

        $query = "select * from doctor_account order by did asc";

        $check_q = $db_host->prepare($query);
        $check_q->execute();

        echo "<br><center><b>Total Doctors registered in server = ".$check_q->rowCount()."</b></center><br>";
        ?><table style="border:1px solid black;width:100%">
            <tr style="border:1px solid black">
            <th>Doctor ID</th>
            <th>Doctor Name</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Date Of Birth</th>
            <th>Experience</th>
            <th>Specialization</th>
            <th>Contact</th>
            <th>Region</th>
            </tr>
        <?php
        while ($row = $check_q->fetch()){
            echo "<tr>";
            echo "<td>".$row['did']."</td>";
            echo "<td>".$row['doctor_name']."</td>";
            echo "<td>".$row['doctor_address']."</td>";
            echo "<td>".$row['doctor_gender']."</td>";
            echo "<td>".$row['doctor_dob']."</td>";
            echo "<td>".$row['doctor_experience']."</td>";
            echo "<td>".$row['doctor_specialization']."</td>";
            echo "<td>".$row['doctor_contact']."</td>";
            echo "<td>".$row['doctor_region']."</td>";
            echo "</tr>";
        }

        unset($db_host);
        ?>
        </table><br>
        <center><button name="returnadmin"><b>Return to admin page</b></button></center>
	</form>
	
</body>
</html>


