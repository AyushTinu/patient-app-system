<?php

require 'patient_dbcon.php';

session_start();
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
           <input type="text" name="patient_password" placeholder="Enter password"> <br><br>
           
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

<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $error = "";
    
    $username = $_POST["patient_username"];
    $password_entered = $_POST["patient_password"];
    $password = "";
    
    if(empty($username)){
        $error = "please Enter username";
        echo $error;
        die();
    }
    elseif(empty($password_entered)){
        $error = "please Enter Password";
        echo $error;
        die();
    }
    elseif(empty($error)){
      $check_str = $db_host->prepare("select * from patient_account where patient_username= :username");
      $check_str -> bindParam(':username', $username, PDO::PARAM_STR);
       
      $check_str->execute();
      
      if($check_str->rowCount() > 0){
          
          while($row = $check_str->fetch()){
              $password = $row['patient_password'];
          }
          
          if($password_entered == $password){
              
              echo "<h3 style='font-family:verdana'>login successful! please wait </h3>";
              
              //this session variable will be used in whole session 
              $_SESSION['patient_username'] = $username;
          
              header("Refresh:0.5 ; url=patient_welcome.php");
          
          }else{
              $error = "Incorrect Password, re-enter password or reset password";
              die();
          }
      }
      else{
          $error = "Incorrect username, the username is not registered";
      }
      }
      echo $error;
 } 
unset($check_str);
unset($db_host);

?>
   