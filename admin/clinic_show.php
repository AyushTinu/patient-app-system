<html>
<head>
	<title>Show Clinics</title>
	<style>
        table , th, td{
            border : 1px solid black;
            border-collapse: collapse
        }
    </style>
</head>
<body>
	<form action="clinic_show.php" method="post" style="font-family: verdana">
	    <h2><center>show all the clinics</center></h2>
       
       <?php
        session_start();

        if(isset($_POST['returnadmin'])){
            header("Refresh:1; url=mainpage.php");
            echo "loading please wait";
        }

        include 'admin_dbcon.php';

        $query = "select * from clinic order by clinic_state, clinic_city, cid asc";

        $check_q = $db_host->prepare($query);
        $check_q->execute();

        echo "<br><center><b>Total Clinics avaliable in server = ".$check_q->rowCount()."</b></center><br>";
        ?><table style="border:1px solid black;width:100%">
            <tr style="border:1px solid black">
            <th>Clinic ID</th>
            <th>Clinic Name</th>
            <th>Clinic address</th>
            <th>Clinic Town</th>
            <th>Clinic City</th>
            <th>Contact No.</th>
            </tr>
        <?php
        while ($row = $check_q->fetch()){
            echo "<tr>";
            echo "<td>".$row['cid']."</td>";
            echo "<td>".$row['clinic_name']."</td>";
            echo "<td>".$row['clinic_address']."</td>";
            echo "<td>".$row['clinic_state']."</td>";
            echo "<td>".$row['clinic_city']."</td>";
            echo "<td>".$row['clinic_contact']."</td>";
            echo "</tr>";
        }

        unset($db_host);
        ?>
        </table>
        <button name="returnadmin"><b>Return to admin page</b></button>
	</form>
	
</body>
</html>


