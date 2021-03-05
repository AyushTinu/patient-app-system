<html>
<head>
	<title></title>
</head>
<body>
	<form action="clinic_delete_doctor.php" method="post" style="font-family: verdana">
	    <h2>delete a doctor form a clinic</h2>
	    
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
?>
