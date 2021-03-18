<?php 


    require "patient_dbcon.php";
    
    $patient_fname = $patient_gender = $patient_dob = $patient_email = $patient_username = $patient_password = $patient_phone = $patient_addr = $patient_city = "";
    $patient_confirm_password = "";
 
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    
     
    $patient_fname = $_POST["patient_fname"];
    $patient_gender = $_POST["patient_gender"];
    $patient_dob = $_POST["patient_dob"];
    $patient_email = $_POST["patient_email"];
    $patient_username = $_POST["patient_username"];
    $patient_password = $_POST["patient_password"];
    $patient_confirm_password = $_POST["patient_confirm_password"];
    $patient_phone = $_POST["patient_phone"];
    $patient_addr = $_POST["patient_addr"];
    $patient_city = $_POST["patient_city"];
    
    if(empty($patient_fname) || empty($patient_gender) || empty($patient_dob) || empty($patient_username) || empty($patient_password) || empty($patient_phone) || empty($patient_addr) || empty($patient_city) || empty($patient_confirm_password)){

    	$error = "<br> please fill all the required fields...";
    }
    
     if($patient_password != $patient_confirm_password){
         $error = "<br> Password do not match please re-enter your password...";
     }
     
     if(strlen($patient_phone) < 10){
         $error = "<br> Please Enter a valid 10 digit phone number";
     }
    
    if(empty($error)){
   	    $check_str = $db_host -> prepare("SELECT * FROM patient_account WHERE (patient_username = :patient_username) && (patient_email = :patient_email)");
   	    $check_str -> bindParam(':patient_username', $patient_username);
        $check_str -> bindParam(':patient_email', $patient_email);
   	    $check_str -> execute();

   	    if($check_str -> rowCount() > 0){
   			echo "username and email already exists";
        	}
   	    else{
   		
            $query = "INSERT INTO patient_account (patient_fname, patient_username, patient_password, patient_address, patient_city, patient_dob, patient_phone, patient_email, patient_gender) VALUES (:patient_fname, :patient_username, :patient_password, :patient_address, :patient_city, :patient_dob, :patient_phone, :patient_email, :patient_gender)";
    
            $stm = $db_host->prepare($query);
            
            if($stm->execute(array(':patient_fname' => $patient_fname,
                                   ':patient_username' => $patient_username,
                                   ':patient_password' => $patient_password,
                                   ':patient_address' => $patient_addr,
                                   ':patient_city' => $patient_city,
                                   ':patient_dob' => $patient_dob,
                                   ':patient_phone' => $patient_phone,
                                   ':patient_email' => $patient_email,
                                   ':patient_gender' => $patient_gender
            ))){
                
                echo "<br><h3 style=\"font-family:verdana\">Patient Registered successfully</h3>";
                header("Refresh:3; url=patient_login.php");
            }
            
            
   	    }
    }

unset($check_str);

unset($db_host);
     
 }
?>


<html>
    <head>
        <title>Patient Register</title>
        <style>
        </style>
    </head>
    <body>
       <form action="patient_register.php" method="post" style="font-family:verdana">
       
        <h2 style="font-family:verdana">
            Registration Form for patient...
        </h2>
        <label><b>Enter Full Name:</b></label><br>
        <input type="text" name="patient_fname" placeholder="Enter Full Name" required><br><br> 
    
          <label><b>Enter username :</b></label><br>
          <input type="text" name="patient_username" placeholder="Enter username"> <br><br>
           <label><b>Enter Password :</b></label><br>
           <input type="text" name="patient_password" placeholder="Enter password"> <br><br>
          
            <label><b>Confirm Password :</b></label><br>
           <input type="text" name="patient_confirm_password" placeholder="Enter password Again"> <br><br>
           <label><b>Date Of Birth: </b></label>
           <input type="date" name="patient_dob" placeholder="Date of Birth"> <br><br>
           <label><b>Enter email :</b></label><br>
           <input type="email" name="patient_email" placeholder="Enter your email"> <br><br>
          
          <label><b>select gender:</b></label> 
            <input type="radio" name="patient_gender" value="male">Male
            <input type="radio" name="patient_gender" value="female">Female
            <input type="radio" name="patient_gender" value="other">Other
            <br><br>
            <label><b>Phone Number :</b></label><br>
            <input type="tel" name="patient_phone" placeholder="enter your phone number"><br><br>
            <label><b>Address :</b></label><br>
            <textarea name="patient_addr" rows="4" cols="30" placeholder="Complete Address"></textarea><br><br>
            <label><b>City :</b></label><br>
            <input type="text" name="patient_city" placeholder="enter city name"><br><br>
            
            <button type="submit" value="Submit" name="formsubmit" >Register</button>
           <b>Already Have an account? <a href="patient_login.php">Login Here</a></b>
           
      
       </form> 
    </body>
</html>