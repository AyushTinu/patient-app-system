<html>
    <head>
        <title>
            mainpage
        </title>
    </head>
    <body>
       <form action="mainpage.php" method="post" style="font-family: verdana">
           <h2>mainpage admin</h2>
           <ul>
              <li class="dropdown">ADMIN MODE                  
              </li>
              
               <li class="dropdown">
                   <a href="javascript:void(0)" class="dropbtn">Clinic</a>
                   <div class="dropdown-content">
                     <a href="clinic_add.php">ADD CLINIC</a>
                     <a href="clinic_delete.php">DELETE CLINIC</a>
                     <a href="clinic_add_doctor.php">ADD DOCTOR TO CLINIC</a>
                     <a href="clinic_delete_doctor.php">DELETE DOCTOR FROM CLINIC</a>
                     <a href="clinic_show.php">SHOW CLINIC</a>
                   </div>
               </li>
               
               <li class="dropdown">
                   <a href="javascript:void(0)" class="dropbtn">DOCTOR</a>
                   <div class="dropdown-content">
                     <a href="doctor_add.php">ADD DOCTOR</a>
                     <a href="doctor_delete.php">DELETE DOCTOR</a>
                     <a href="doctor_show.php">SHOW DOCTOR</a>
                     <a href="doctor_show_schedule.php">SHOW DOCTOR SCHEDULE</a>
                   </div>
               </li>
               
               <li>
                   <form method="post" action="mainpage.php">
                       <button type="submit" name="logout">Logout</button>
                   </form>
               </li>
           </ul>
           
       </form>
       <?php 
       session_start();
       if(isset($_POST['logout'])){
           session_unset();
           session_destroy();
           header("Refresh:1; url=admin_login.php");
       }
       ?>
        
    </body>
</html>