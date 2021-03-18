<?php
session_start();
include 'patient_dbcon.php';
$username = $_SESSION['patient_username'];
//$username = 'tinu';
$previously = $db_host -> prepare('select * from patient_account where patient_username = :username');
$previously -> bindParam(':username', $username);
$previously -> execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=auto, initial-scale=1.0">
    <title>Document</title>
    <style>
        form, h3{
            font-family : verdana;
        }
    </style>
</head>
<body>
    <form method="post" action="patient_modify.php">
    
    <h1>Modify Your account information</h1><br>
    <Label>Username : <?php echo $_SESSION['patient_username']; ?></Label><br><br>
    <label for="password">Enter Your Password to confirm Modification: </label>
    <input type="text" name="password" style="width=400px">
    <br>
    <br>
    <?php
    if($previously -> rowCount() > 0){
        while($row1 = $previously->fetch(PDO::FETCH_ASSOC)){

    ?>
    <!-- Here all the fields will be autofilled by Default the user can change this info if wanted -->
    Full Name: <input type="text" name='fname' value="<?php echo $row1['patient_fname'];?>">
    <br><br>
    Address: <input type="text" name="address" value="<?php echo $row1['patient_address'];?>">
    <br><br>
    City: <input type="text" name="city" value="<?php echo $row1['patient_city'];?>">
    <br><br>
    Phone No.: <input type="text" name="phone" value="<?php echo $row1['patient_phone'];?>">
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $row1['patient_email'];?>">
    <br><br>
    
    <?php
        }
    }
    ?>

    Gender: <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="other">Other
    <br><br>
    
    <button type="submit" name="submit">Modify Information</button>
    <button name="return-settings"><b>Return to settings page</b></button>
</form>
</body>
</html>

<?php
if(isset($_POST['return-settings'])){
    header('Refresh:0.5;url=patient_settings.php');

}
if(isset($_POST['submit'])){
    $password = $_POST['password'];
    $new_name = $_POST['fname'];
    $new_address = $_POST['address'];
    $new_city = $_POST['city'];
    $new_phone = $_POST['phone'];
    $new_email = $_POST['email'];
    //$new_gender = $_POST['gender'];

    if(empty($_POST['password'])){
        echo 'password cannot be empty';
    }else{
        //check password if it is correct
        $check = $db_host->prepare("SELECT * From patient_account where patient_username = :username1");
        $check -> bindParam(':username1', $username);
        $check ->execute();
        if($check -> rowCount() > 0){
            while($row = $check->fetch()){
                $previous_pass = $row['patient_password'];
            }
            if($previous_pass == $password){
                //modify the values and proceed the request
                if(empty($_POST['gender'])){
                    echo 'Select Gender';
               }
                else{
                    $new_gender = $_POST['gender'];

                    $modify_data = $db_host->prepare("UPDATE patient_account 
                    SET patient_fname = :fname, patient_address = :addr,
                    patient_city = :city, patient_phone = :phone, 
                    patient_email = :email, patient_gender = :gender 
                    WHERE patient_username = :username2");
                    
                    $modify_data -> bindParam(':username2' , $username);
                    $modify_data -> bindParam(':fname' , $new_name);
                    $modify_data -> bindParam(':addr' , $new_address);
                    $modify_data -> bindParam(':city' , $new_city);
                    $modify_data -> bindParam(':phone' , $new_phone);
                    $modify_data -> bindParam(':email' , $new_email);
                    $modify_data -> bindParam(':gender' , $new_gender);
                    
                    if($modify_data -> execute()){
                        echo "<h3>Record Updated Successfully<h3>";
                    }
                  } 
            }else{
                echo "the password do not match you cant modify the data in the server";
            }
        }
    }
}
?>