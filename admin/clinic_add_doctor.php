<html>
<head>
	<title></title>
</head>
<body>
	<form action="clinic_add_doctor.php" method="post" style="font-family: verdana">
	    <h2>Add a New Doctor To a Clinic</h2>
       
        <label><b>City: </b></label>    
        <select name="city" id="city_list" onChange="getState(this.value);getDoctorRegion=(this.region);">
            <option value="">Select City</option>
            <?php 
            include "admin_dbcon.php";
            $sql1 = "select distinct clinic_city from clinic";
            $result = $db_host->prepare($sql1);
            $result->execute();
            
            while($rs = $result->fetch())
            {
            ?>
            <option value="<?php echo $rs['clinic_city'];?>"><?php echo $rs['clinic_city']; ?></option>
            <?php
            }
            ?>
        </select>                
          <br>
          
        <label><b>Clinic: </b></label>    
        <select name="clinic" id="clinic_list">
            <option value="">Select Clinic</option>
            <?php 
            include "admin_dbcon.php";
            $sql2 = "select cid,clinic_name from clinic";
            $result = $db_host->prepare($sql2);
            $result->execute();
            
            while($rs = $result->fetch())
            {
            ?>
            <option value="<?php echo $rs['cid'];?>"><?php echo $rs['clinic_name']." - ".$rs['cid']; ?></option>
            <?php
            }
            ?>  
        </select>
           <br>
           
        <label><b>Doctor: </b></label>
        <select name="doctor" id="doctor-list">
            <option value="">Select Doctor</option>
            <?php 
            include "admin_dbcon.php";
            $sql3 = "select did,doctor_name, doctor_region from doctor_account";
            $result = $db_host->prepare($sql3);
            $result->execute();
            
            while($rs = $result->fetch())
            {
            ?>
            <option value="<?php echo $rs['did'];?>"><?php echo $rs['doctor_name']." - ".$rs['doctor_region']; ?></option>
            <?php
            }
            ?>
        </select>
        <br>
        
        <label><b>Select Avaliablity</b></label>
        <table>
            <tr><td>Monday </td><td><input type="checkbox" name="daylist[]" value="monday"/></td></tr>
            <tr><td>Tuesday </td><td><input type="checkbox" name="daylist[]" value="tuesday"/></td></tr>
            <tr><td>Wednesday </td><td><input type="checkbox" name="daylist[]" value="wednesday"/></td></tr>
            <tr><td>Thursday </td><td><input type="checkbox" name="daylist[]" value="thursday"/></td></tr>
            <tr><td>Friday </td><td><input type="checkbox" name="daylist[]" value="friday"></td></tr>
            <tr><td>Saturday </td><td><input type="checkbox" name="daylist[]" value="saturday"/></td></tr>
            <tr><td>Sunday </td><td><input type="checkbox" name="daylist[]" value="sunday"/></td></tr>
        </table>
        <br>
        
        <label><b>Doctor Avaliable From Time:</b></label><br>
        <input type="time" name="starttime">
        
        <label><b>to </b></label>
        <input type="time" name="endtime">
        
        <br><br>
        <button name="submit" type="submit"><b>Assign Doctor</b></button>
         	        	    
        <button name="returnadmin"><b>Return to admin page</b></button>
	</form>
	
</body>
</html>


<?php
session_start();

if(isset($_POST['returnadmin'])){
    header("Refresh:1; url=mainpage.php");
    echo "loading please wait";
}

if(isset($_POST['submit'])){
    
    include 'admin_dbcon.php';
    
    $cid = $_POST['clinic'];
    $did = $_POST['doctor'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    
    foreach($_POST['daylist'] as $daylist){
        $sql_i = "insert into doctor_avaliablity (cid, did, day, start_time, end_time) values (:cid, :did, :daylist, :starttime, :endtime)";
        $exe_q = $db_host->prepare($sql_i);
        if($exe_q->execute(array(':cid' => $cid,
                                 ':did' => $did,
                                 ':daylist' => $daylist,
                                 ':starttime' => $starttime,
                                 ':endtime' => $endtime
                                ))){
            echo "doctor avaliable on ".$daylist."<br>";
        }
        else{
            echo "some error occured";
        }
        
    }
    unset($db_host);
}
?>
