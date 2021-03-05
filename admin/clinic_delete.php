<html>
<head>
	<title></title>
</head>
<body>
	<form action="clinic_delete.php" method="post">
	    <h2>Select a clinic to delete it form the server</h2>
	       By Clinic ID:<input type="number" name="cid">
	       <br>
	       <button name="submit" type="submit">Delete by CID</button>
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

if(isset($_POST['submit'])){
    
    $cid = $_POST['cid'];
    
    $check_stmt = $db_host->prepare("select * from clinic where cid = :cid");
    $check_stmt->bindValue(":cid", $cid);
    $check_stmt->execute();
    
    if($check_stmt->rowCount() > 0){
        
        $del_stmt = $db_host->prepare("DELETE FROM clinic WHERE cid = :cid");
        $del_stmt->bindValue(':cid', $cid);
        if($del_stmt ->execute()){
            echo "clinic deleted";
            header("Refresh:1; url=mainpage.php");
        }
    }elseif(empty($cid)){
        echo "please Enter a cid";
    }
        
    else{
        echo "cannot delete invalid cid";
    }
    
    unset($check_stmt);
    unset($del_stmt);
    unset($db_host);
}
?>
