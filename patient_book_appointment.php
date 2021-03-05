<?php 

include 'patient_dbcon.php';

session_start();

$patient_fname = $patient_gender = $patient_age = $patient_dateofbooking = $patient_problem = "";

    if(isset($_POST['home'])){
        //return to home page if home button is pressed
        echo "returning to home page";
        header("Refresh:3 ; url=patient_welcome.php");
    }

if(isset($_POST['submit'])){
    $error = null;
        //taking the session value and initialize it
        $patient_username = $_SESSION['patient_username'];
    
            $patient_fname = $_POST['patient_fname'];
            $patient_gender = $_POST['patient_gender'];
            $patient_age = $_POST['patient_age'];
            $patient_dateofbooking = $_POST['patient_dateofbooking'];
            $patient_problem = $_POST['patient_problem'];
            
    
    $book_status = "confirm";
    
        if(empty($patient_fname) || empty($patient_gender) || empty($patient_age) || empty($patient_dateofbooking) || empty($patient_problem)){
            $error = "Please fill all the fields";
            echo $error;
        }
    
        if($patient_age < 18){
            $error = "18+only allowed";
            echo $error;
        }
        if(empty($error)){
            
    //insert query
                $query = "INSERT INTO patient_bookings(book_status, patient_fname, patient_username, patient_age, patient_gender, patient_problem, patient_dateofbook) VALUES (:book_status, :patient_fname, :patient_username, :patient_age, :patient_gender, :patient_problem, :patient_dateofbooking)";
    
                $insert_data = $db_host->prepare($query);
    
                //execute function which assigns the value through an array 
                if($insert_data -> execute(array(':book_status' => $book_status,
                                                 ':patient_fname' => $patient_fname, 
                                                 ':patient_username' => $patient_username, 
                                                 ':patient_gender' => $patient_gender , 
                                                 ':patient_age' => $patient_age,
                                                 ':patient_dateofbooking' => $patient_dateofbooking,
                                                 ':patient_problem' => $patient_problem)))
                {
                    echo "<br><h3 style='font-family:verdana'>Booking Successfull<h3><br>";
                    header("Refresh:3 ; url=patient_welcome.php");
                }
                unset($db_host);
                unset($insert_data); 
        }
    }

?>


<html>
    <head>
        <title>
            Book Appointment
        </title>
        <style>
            form{
                border: 2px solid black;
                width: 50%;
            }</style>
    </head>
    <body>
        <form style="font-family:verdana" action="patient_book_appointment.php" method="post">
            <h2>Book an appiontment</h2>
            <br><?php echo "currently running ".$_SESSION['patient_username']."'s session.";?>
            <br><br>
            <label><b>Enter Full Name:</b></label><br>
            <input type="text" name="patient_fname" placeholder="Enter Full Name"><br><br>
            <label><b>select gender:</b></label> 
            <input type="radio" name="patient_gender" value="male">Male
            <input type="radio" name="patient_gender" value="female">Female
            <input type="radio" name="patient_gender" value="other">Other
            <br><br>
            <label><b>Enter age:</b></label><br>
            <input type="text" name="patient_age" placeholder="Enter patient age"><br><br>
            <label><b>Select Date of appointment</b></label><br>
            <input type="date" name="patient_dateofbooking" placeholder="Select Date of Appointment"><br><br>
            
            <label><b>Enter Your Problems:</b></label><br>                
            <textarea name="patient_problem" placeholder="enter all your problems you have. seperate with commas ',' " rows="6" cols="30"></textarea><br><br>
            
            <button name="submit" type="submit"><b>Book appointment</b></button>
            <button name="home"><a href="patient_welcome.php"></a><b>Home</b></button><br><br>
        </form>
    </body>
</html>