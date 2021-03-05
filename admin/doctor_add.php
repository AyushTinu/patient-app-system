<html>
<head>
	<title></title>
</head>
<body>
	<form action="doctor_add.php" method="post" style="font-family: Arial">
	    <h2>Add a New Doctor</h2>
	    	Doctor ID:<input type="number" name="did" >
	    	<br>
	    	Doctor Name: <input type="text" name="dname">
	    	<br>
	    	Doctot Address: <input type="text" name="daddress">
	    	<br>
	    	Gender : <input type="radio" name="dgender" value="male">Male
	    			<input type="radio" name="dgender" value="female">Female 
	    	<br>
	    	Date Of Birth: <input type="date" name="ddob">
	    	<br>
	    	Years of Experience: <input type="number" name="dexp" size="5">
	    	<br>
	    	Specialization: <input type="text" name="dspecial">
	    	<br>
	    	Contact No: <input type="number" name="dcontact">
	    	<br>
	    	Username: <input type="text" name="dusername">
	    	<br>
	    	Password: <input type="password" name="dpassword">
	    	<br>
	    	Region of Clinic: <input type="text" name="dregion">
	    	<br>
	    	<button type="submit" name="submit"><b>Register New Doctor</b></button>

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

$did = $dname = $daddress = $dgender = $ddob = $dexp = $dspecial = $dusername = $dpassword = $dregion = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	require 'admin_dbcon.php';

	if(isset($_POST['submit'])){

		$did = $_POST['did'];
		$dname = $_POST['dname'];
		$daddress = $_POST['daddress'];
		$dgender = $_POST['dgender'];
		$ddob = $_POST['ddob'];
		$dexp = $_POST['dexp'];
		$dspecial = $_POST['dspecial'];
		$dusername = $_POST['dusername'];
		$dpassword = $_POST['dpassword'];
		$dregion = $_POST['dregion'];

		$query = "select * from doctor_account where did = :did";

		$check_stm = $db_host->prepare($query);
		$check_stm ->bindValue(":did" , $did);
		$check_stm -> execute();

		if($check_stm->rowCount()>0){
			echo "This did already exist select a new one";
		}

		else{

			$query_insert = "insert into doctor_account (did, doctor_name, doctor_address, doctor_gender, doctor_dob, doctor_experience, doctor_specialization, doctor_username, doctor_password, doctor_contact, doctor_region)
			 value (:did , :dname, :daddress, :dgender, :ddob, :dexp, :dspecial, :dusername, :dpassword, :dcontact, :dregion)";
			$insert_q = $db_host->prepare($query_insert);
			if($insert_q->execute(array(
				':did' => $did,
				':dname' => $dname,
				':daddress' => $daddress,
				':dgender' => $dgender,
				':ddob' => $ddob,
				':dexp' => $dexp,
				':dspecial' => $dspecial,
				':dusername' => $dusername,
				':dpassword' => $dpassword,
				':dcontact' => $dpassword,
				':dregion' => $dregion
			))){
				echo "Doctor Registered Successfully";
				header("Refresh:1; url=mainpage.php");
			}
			else{
				echo "There is an error in executing the code";
			}

		unset($insert_q);	
		}

	unset($check_stm);
	}
	unset($db_host);
}
?>
