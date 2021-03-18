<?php
session_start();
include 'patient_dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            font-family:verdana;

        }
    </style>
</head>
<body>
    <form method='post' action='patient_delete_account.php'>

    <h1>Are You Sure You want to Delete this account?
    <h2><label>Username : <?php echo $_SESSION['patient_username']?></label></h2>
    
    <label>Confirm Password : </label>
    <input type="text" name='password'>
    <br><br>
    <button name='delete-btn' type='submit'>Delete Account</button>
    <br><br>
    <button name="return-settings" type='submit'>Return to settings</button>
    <br><br>
</form>
</body>
</html>
<?php
if(isset($_POST['return-settings'])){
    header('Refresh:0.3;url=patient_settings.php');
}
if(isset($_POST["delete-btn"])){
    
    $username = $_SESSION['patient_username'];
    $password_entered = $_POST['password'];
    //this select query for fetching the password and checking it
    $check_str = $db_host->prepare("select * from patient_account where patient_username = :username");
    $check_str ->bindParam(':username', $username);
    $check_str->execute();
    
    if($check_str->rowCount() > 0){
        while($row = $check_str->fetch(PDO::FETCH_ASSOC)){
            
            $password = $row['patient_password'];
        
            if($password_entered == $password){

            $delete_acc = $db_host->prepare("DELETE FROM patient_account WHERE patient_username = :patient_username");        
            $delete_acc -> bindParam(':patient_username', $username);       
            
            if($delete_acc -> execute()){
                echo "Account Deleted successfully redirecting to login page";
                session_unset();
                session_destroy();
                header('Refresh:5; url=patient_login.php');
            }

        }
        else{
            echo "incorrect Password<br>confirm password first";
        }
        }
}
}
unset($check_str);
unset($delete_acc);
unset($db_host);
?>