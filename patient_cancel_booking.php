
   <html>
    <head>
        <title>
            Booking cancel
        </title>
    </head>
    <body>

    <?php 
    session_start();
    ?>
        <form style="font-family:verdana" action="patient_cancel_booking.php" method="post">
            <h2>Cancel Booking</h2>
            <br>
            <?php echo "<b>".$_SESSION['patient_username']."'s</b> session running.";?>
            
            <select name="appoint" id="appointment_list" style="width:40%;height:35px">
              
                <option value="">Select Appointment</option>
                <?php
                include 'patient_dbcon.php';
                
                $_SESSION['patient_username'] = $username;
                
                $sqlq = "select * from patient_bookings where patient_username = :username";
                
                $exeq = $db_host->prepare($sqlq);
                $exeq->bindParam(":username", $username);
                $exeq->execute();
                if($exeq -> rowCount() > 0){
                    while($row = $exeq->fetch())
                    {
                        //closing php tag for some html tags
                    ?>
                        <option value="<?php echo $row['book_id']." - ".$row['patient_fname']." - ".$row['patient_problem'] ?>"><?php echo $row['book_id']." - ".$row['patient_fname']." - ".$row['patient_problem'] ;?></option>
                    <?php
                    }
                }
                ?>             
            </select>
            <button name='cancel' ></button>
        <button name="home" type="submit" style="font-family:verdana"><b>Home</b></button>
        </form>
<?php

include 'patient_dbcon.php';

if(isset($_POST['home'])){
    //echo "<label>Returning to homepage</label>";
    header("Refresh:0.2;url=patient_welcome.php");
}
                
?>
    </body>
</html>


