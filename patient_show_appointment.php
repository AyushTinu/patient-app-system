<?php
session_start();
?>
   <html>
    <head>
        <title>
            show page 
        </title>
        <style>
            table{
                border: 1px solid black;
                width: 100%;
            }
            td{
                border: 1px solid black;
            }
            th{
                
                border: 2px solid black;
                background: #11111111;
            }
        </style>
    </head>
    <body>
        <form style="font-family:verdana" action="patient_show_appointment.php" method="post">
           <h2>Currently running <?php echo $_SESSION['patient_username']."'s";?> session</h2>
            <?php 
            
            require 'patient_dbcon.php';
            
            echo "<table style='border: solid 1px black;'>";
            echo "<tr><th>id</th><th>form submitted</th><th>patient name</th><th>age</th><th>gender</th><th>problems</th><th>booking date</th></tr>";
            
            $session_username = $_SESSION['patient_username'];
            $checkQ = $db_host->prepare("select * from patient_bookings where patient_username = :patient_username");
            $checkQ->bindParam(':patient_username', $session_username);
            $checkQ->execute();
            
            if($checkQ->rowCount() > 0){
          
                while($row = $checkQ->fetch(PDO::FETCH_ASSOC)){
                    $bookid = $row['book_id'];
                    $bookdatetime = $row['book_datetime'];
                    $fname = $row['patient_fname'];
                    $age = $row['patient_age'];
                    $gender = $row['patient_gender'];
                    $problems = $row['patient_problem'];
                    $dateofbook = $row['patient_dateofbook'];
                    
                    echo "<tr><td>".$bookid."</td><td>".$bookdatetime."</td><td>".$fname."</td><td>".$age."</td><td>".$gender."</td><td>".$problems."</td><td>".$dateofbook."</td></tr>";
                }
            }
            echo "</table>";

            unset($db_host);
            unset($execute_query);
            
            ?>            
           <button name="home" type="submit"><b>Home</b></button>
  
        </form>
       
        <?php
            if(isset($_POST['home'])){
                header("Refresh:0.2;url=patient_welcome.php");
            }
        ?>
    </body>
</html>