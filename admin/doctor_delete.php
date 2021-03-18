<html>
<head>
	<title></title>
</head>
<body>
	<form action="doctor_delete.php" method="post" style="font-family: Arial">
	    <h2>delete a doctor from the server</h2>
	    <label><b>Doctor ID:</b></label><br>
	    <input type="number" name="did"><br>
	    <button name="submit" type="submit">Delete By DID</button>
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

require 'admin_dbcon.php';

if(isset($_POST["submit"])){
	
	$did = $_POST['did'];

	//this query will check the did if it is avaliable or not
	$check_q = "select * from doctor_account where did = :did";
	$check_stm = $db_host->prepare($check_q);
	$check_stm -> bindValue(':did', $did);
	$check_stm -> execute();

	//if did is avaliable here we'll delete the row 
	if($check_stm->rowCount() > 0){
        // Here We Delete form the doctor account table

		$delete_stm = $db_host->prepare("delete from doctor_account where did = :did");
		$delete_stm->bindValue(':did', $did);
		if($delete_stm->execute()){
            $delete_da = $db_host->prepare("delete from doctor_availability where did = :didda");
            $delete_da -> bindValue(':didda', $did);
            if($delete_da->execute()){
			     echo "the doctor is deleted";
			     //header("Refresh:0.5; url=mainpage.php");
            }
		}
		else
        {
			echo "some error occured";
		}

		unset($delete_stm);
		unset($db_host);
	}
	else{
		//if did is not in the table this else block will execute
		echo "there is no doctor with this did";
	}
	unset($db_host);
	
	unset($check_stm);
}
?>
