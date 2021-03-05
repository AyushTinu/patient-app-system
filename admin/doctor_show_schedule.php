<html>
<head>
	<title>show doctor schedule</title>
</head>
<body>
	<form action="doctor_show_schedule.php" method="post">
	    <h2>Show the selected doctor schedules</h2>
	    
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
