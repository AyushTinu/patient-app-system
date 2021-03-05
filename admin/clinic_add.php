<html>
<head>
	<title>add clinic</title>
</head>
<body>
	<form action="clinic_add.php" method="post">
	    <h2>Add a New Clinic</h2>
	    Clinic ID: <input type="number" name="cid">
       <br>
       Clinic Name: <input type="text" name="cname">
       <br>
       Clinic Address: <input type="text" name="caddress">
       <br>
       Clinic Town: <input type="text" name="ctown">
       <br>
       Clinic City: <input type="text" name="ccity">
       <br>
       Contact No.: <input type="number" name="ccontact">
       <br><br>
       <button type="submit" name="submit">Register</button>
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

include "admin_dbcon.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
    $caddress = $_POST['caddress'];
    $ctown = $_POST['ctown'];
    $ccity = $_POST['ccity'];
    $contact = $_POST['ccontact'];
    
    $query = "INSERT INTO `clinic`(`cid`, `clinic_name`, `clinic_address`, `clinic_town`, `clinic_city`, `clinic_contact`) VALUES (:cid, :cname, :caddress, :ctown, :ccity, :ccontact)";
    
    $stmt = $db_host->prepare($query);
    if($stmt->execute(array(':cid'=>$cid, ':cname'=>$cname, ':caddress'=>$caddress, ':ctown'=>$ctown, ':ccity'=>$ccity,':ccontact'=>$contact))){
        echo "<br>Clinic Registered successfylly";
            header("Refresh:1;url=mainpage.php");
    }
    
    unset($db_host);
    unset($stmt);
}
?>
