<html>
    <head>
        <title>
            welcome page
        </title>
        <style>
            button{
                float: left;
                font-family: verdana;
            }
        </style>
    </head>
    <body>
       <?php 
        //initializa session start
        session_start(); 
        ?>
        
           <h1 style="font-family:monospace"><center><b>WELCOME to your homepage <?php echo "<i>".$_SESSION['patient_username']."</i>";?></b></center></h1>
           <center>
            <form action="patient_welcome.php" method="post" style="font-family:verdana; height: 60%; width: 50%; border: 1px solid black">
            <br><br>
            <input name="settings-image" type="image" src="images/settings.png" style="float:right ;heignt: 50px; width: 50px" />
            <br>
            <button name="options" style="float:right"><strong>Settings</strong></button>        
            <br><br>
            <button name="book"><b>Book Appointment</b></button>
            <!---Displaying a settings image --->
            
            <br><br>
            <button name="show"><b>Show Appointments</b></button>
            <br><br>
            <button name="cancel"><b>Cancel Appointments</b></button>
            <br><br>
            <button name="logout"><b>Logout</b></button>
            <br><br>
            
            
            <?php
            
            if(isset($_POST['book'])){
                header("Refresh:0.5; url=patient_book_appointment.php");
            }
            elseif(isset($_POST['show'])){
                header("Refresh:0.5 ; url=patient_show_appointment.php");
            }
            elseif(isset($_POST['cancel'])){
                header("Refresh:0.5 ; url=patient_cancel_booking.php");
            }
            elseif(isset($_POST['options'])){
                header("Refresh:0.5; url=patient_settings.php");
            }
            if(isset($_POST["logout"])){
                
                session_unset();
                session_destroy();
                echo "<label style='font-family:verdana'>Logging you out Please wait</label>";
                header("Refresh:0.6 ; url=patient_login.php");
            }
            
            ?>
            
        </form>    
        </center>
    </body>
</html>