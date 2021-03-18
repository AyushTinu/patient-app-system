<!---
------------------------------------
     Modify information of the user
------------------------------------
--->

<?php
session_start();
?>

<html>
    <head>
        <title>
           settings
        </title>
         <style>
                h1, label{
                    background-color : yellow;
                    font-family: monospace;
                    
                }
             form{
                 font-family: monospace;
             }
            </style>
    </head>
    <body>
       <div class="header">
           <center><h1>Settings</h1></center>
           <label style="font-size:30"><a href="patient_welcome.php"><b>&#60 HOME</b></a></label>
       </div>
       <form action="patient_settings.php" method="post">
             <h2><?php echo $_SESSION['patient_username'];?>'s Session Running</h2>
        <button type='submit' name="modify-info">Click to modify info from the database</button>   
             <br><br>
        <button type="submit" name="delete-page">For Deleting The Account</button><label>Warning: This option will delete the account and user information form database.</label>
       </form>
       
<?php
if(isset($_POST['modify-info'])){
    echo 'loading...';
    header('Refresh:0.2;url=patient_modify.php');
}
if(isset($_POST['delete-page'])){
    header('Refresh:0.2; url=patient_delete_account.php');
}
?>      

    </body>
</html>