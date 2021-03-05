<?php

require 'patient_dbcon.php';

session_start();

$patient_username = $patient_password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $error = "";
    
    $username = $_POST["patient_username"];
    $password = $_POST["patient_password"];
    
    if(empty($username)){
        $error = "please Enter username";    
    }
    elseif(empty($password)){
        $error = "please Enter Password";
    }
    elseif(empty($error)){
    $check_str = $db_host->prepare("select * from patient_account where (patient_username = :username) && (patient_password = :password)");
    $check_str -> bindParam(':username', $username, PDO::PARAM_STR);
    $check_str -> bindParam(':password', $password, PDO::PARAM_STR);
    
    $check_str->execute();
    
    //$result = $check_str->fetch(PDO::FETCH_OBJ);
    
    if($check_str->rowCount() > 0){
        //this session variable will be used in whole session 
        $_SESSION['patient_username'] = $username;
        //$_SESSION['patient_fname'] = $patient_fname;
        
        if($password_entered = $password){
            echo "<h3 style='font-family:verdana'>login successful! please wait </h3>";
            header("Refresh:3 ; url=patient_welcome.php");
        
        }
    }
    else{
        $error = "Incorrect username or password";
    }
    }
 }
unset($check_str);
unset($db_host);

?>
   

   <html>
    <head>
        <title>patient_login</title>
    </head>
    <body>
       <form action="patient_login.php" method="post" style="font-family:verdana">
        <h2>
            Patient Login...
        </h2>
       
          <label><b>Enter username :</b></label><br>
          <input type="text" name="patient_username" placeholder="Enter username"> <br><br>
           <label><b>Enter Password :</b></label><br>
           <input type="password" name="patient_password" placeholder="Enter password"> <br><br>
           
           <button name="login-btn" style="font-family:verdana">Login</button>
           <label><a href="patient_register.php">Create new account</a></label>
           
           <div class="footer">
               <ul style="position:absolute; top:93%; background-color:yellow">
                   <li><a href="admin/admin_login.php">Admin Login</a></li>
               </ul>
           </div>
           
       </form> 
    </body>
</html>