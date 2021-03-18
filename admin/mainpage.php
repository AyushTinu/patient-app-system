<html>
    <head>
        <title>
            mainpage
        </title>
        <style>
            .dropdown:hover .dropdown-content{
                display: block;
            }
            li{
                display: inline-block;    
            }
            li.dropdown{
                display: inline-block;    
            }
            
            .dropdown-content{
                display: none;
                position: absolute;
                background-color: white;
                z-index: 1;
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
       <form action="mainpage.php" method="post" style="font-family: verdana">
           <h2>mainpage admin</h2>
           <ul>
              <li class="dropdown">ADMIN MODE                  
              </li>
              
               <li class="dropdown">
                   <a href="javascript:void(0)" class="dropbtn">CLINIC</a>
                   <div class="dropdown-content">
                     <a href="clinic_add.php">ADD CLINIC</a><br>
                     <a href="clinic_delete.php">DELETE CLINIC</a><br>
                     <a href="clinic_add_doctor.php">ADD DOCTOR TO CLINIC</a><br>
                     <a href="clinic_delete_doctor.php">DELETE DOCTOR FROM CLINIC</a><br>
                     <a href="clinic_show.php">SHOW CLINIC</a><br>
                     <a href="clinic_region.php">MANAGE REGIONS AVAILABLITY</a><br>
                   </div>
               </li>
               
               <li class="dropdown">
                   <a href="javascript:void(0)" class="dropbtn">DOCTOR</a>
                   <div class="dropdown-content">
                     <a href="doctor_add.php">ADD DOCTOR</a><br>
                     <a href="doctor_delete.php">DELETE DOCTOR</a><br>
                     <a href="doctor_show.php">SHOW DOCTOR</a><br>
                     <a href="doctor_show_schedule.php">SHOW DOCTOR SCHEDULE</a><br>
                   </div>
               </li>
               
               <li>
                   <form method="post" action="mainpage.php">
                       <button type="submit" name="logout">Logout</button>
                   </form>
               </li>
           </ul>
           <br>
           <a href="searchpage.php">Search Page for searching the patients in the server</a>
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