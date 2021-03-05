<html>
    <head>
        <title>
            welcome page
        </title>
    </head>
    <body>
       <?php 
        //initializa session start
        session_start(); 
        ?>
        <form action="patient_welcome.php" method="post" style="font-family:verdana">
           <h1>WELCOME to your homepage <?php echo "<i>".$_SESSION['patient_username']."</i>";?></h1>
            <br><br>
            <button style="font-family:verdana" name="book"><b>Book Appointment</b></button>
            <br><br>
            <button style="font-family:verdana" name="show"><b>Show Appointments</b></button>
            <br><br>
            <button style="font-family:verdana" name="cancel"><b>Cancel Appointments</b></button>
            <br><br>
            <button style="font-family:verdana" name="logout"><b>Logout</b></button>
            <br>
            
            <?php
            
            if(isset($_POST['book'])){
                header("Refresh:1; url=patient_book_appointment.php");
            }
            elseif(isset($_POST['show'])){
                header("Refresh:1 ; url=patient_show_appointment.php");
            }
            elseif(isset($_POST['cancel'])){
                header("Refresh:1 ; url=patient_cancel_booking.php");
            }
            if(isset($_POST["logout"])){
                
                session_unset();
                session_destroy();
                echo "<label style='font-family:verdana'>Logging you out Please wait</label>";
                header("Refresh:3 ; url=patient_login.php");
            }
            
            ?>
        </form>
    </body>
</html>