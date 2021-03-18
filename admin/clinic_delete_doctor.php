<?php
require 'admin_dbcon.php';

session_start();

if(isset($_POST['returnadmin'])){
    header("Refresh:1; url=mainpage.php");
    echo "loading please wait";
}
?>
<html>
<head>
	<title>remove a doc</title>
    <style>
        form{
            font-family: verdana;
            border: 1px solid black;
        }
    </style>
    <script>
        function getstate(val) {
            $.ajax({
                type: "POST",
                url: "getclinic.php",
                data: 'city='+val,
                success: function(data){
                    $("#clinic-list").html(data);
                }
            });
        }
        
        function getDoctorDay(val) {
            $.ajax({
                type: "POST",
                url: "getdoctorday.php",
                data: 'did='+val,
                success: function(data){
                    $("#doctor-list").html(data);
                }
            });
        }
    </script>
</head>
<body>
	<form action="clinic_delete_doctor.php" method="post">
	    <h2>Delete a doctor form a clinic</h2>
	    <!--- here show all the doctors avaliable in the database --->
        <table>
        <tr>
            <th>Doctor ID</th>
            <th>Username</th>
            <th>Doctor Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Spelization</th>      
            <th>Experience</th>
            <th>Contact</th>
            <th>Region</th>
        </tr>
        <?php
        $select_query = $db_host->prepare("select * from doctor_account");
        $select_query->execute();
        while($row = $select_query->fetch()){
            echo "<tr>";
            echo "<td>".$row['did']."</td>";
            echo "<td>".$row['doctor_username']."</td>";
            echo "<td>".$row['doctor_name']."</td>";
            echo "<td>".$row['doctor_gender']."</td>";
            echo "<td>".$row['doctor_dob']."</td>";
            echo "<td>".$row['doctor_specialization']."</td>";
            echo "<td>".$row['doctor_experience']."</td>";
            echo "<td>".$row['doctor_contact']."</td>";
            echo "<td>".$row['doctor_region']."</td>";
            echo "<tr>";
        }
        ?>
        </table>
        <form action="clinic_delete_doctor" method="post">
        <!--- Here show all the City --->
        <label>Select the City</label>
            
        <select name="city">
            <option value="">Select Region</option> 
            <?php
                // SELECT QUERY IN HERE HERE SELECT ALL THE REGIONS AVALIABLE IN SERVER
                $select_city = $db_host->prepare("select distinct clinic_city from clinic");
                $select_city -> execute();
                while($row = $select_city->fetch()){
                    ?>
                    <option value="<?php echo $row['clinic_city']; ?>"><?php echo $row['clinic_city']; ?></option>
                <?php    
                }

            ?>
            </select>
            <button name='city-send' type='button' onClick="getElementById()">Next</button>
            </form>
            <form action="clinic_delete_doctor.php" method="POST">
            <!--- new Query --->
            <?php 
            if(isset($_POST['city-send']))
            {
            ?>
            <!--- Here show all the Clinic In those cities --->
            <label>Select the Clinic</label>
                
            <select>
                <option value="">Select Clinic</option> 
                <?php
                    // SELECT QUERY IN HERE HERE SELECT ALL THE REGIONS AVALIABLE IN SERVER
                    $select_city = $db_host->prepare("select distinct clinic_name from clinic where clinic_city = :city");
                    $select_city -> bindValue(':city', $_POST['city']);
                    $select_city -> execute();
                    if($select_city->rowCount > 0){

                    while($row = $select_city->fetch()){
                        ?>
                        <option value="<?php echo $row['clinic_name']; ?>"><?php echo $row['clinic_name']; ?></option>
                    <?php    
                    }
                }
                ?>
            </select>
            <?php
            }
            ?>
        </form>
        

        <button name="returnadmin" style="float:right"><b>Return to admin page</b></button>
	</form>
	
</body>
</html>
