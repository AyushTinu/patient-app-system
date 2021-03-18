 <?php
session_start();
        
if(isset($_POST['submit'])){
     
    if($_POST['username']=='admin' && $_POST['password']=='admin'){
        $_SESSION['userName'] = 'admin';
        echo "logging in";
        header("Refresh:0.5; url=mainpage.php");
        
    }
    else{
        echo "wrong username or password";
    }   
}

if(isset($_POST['return'])){
    header("Refresh:0.5 ; url=../patient_login.php");
}
?>

<html>
    <head>
        <title>
            admin login
        </title>
    </head>
    <body>
        <form style="font-family: verdana" action="admin_login.php" method="post">
            <label><b>Username</b></label><br>
            <input type="text" name="username" placeholder="Enter admin username" size="30"><br><br>
            
            <label><b>Password</b></label><br>
            <input type="text" name="password" placeholder="Enter admin password"><br><br>
            
            <button type="submit" name="submit">Login</button>
            <div class="footer">
                <button type="submit" name="return" style="position:absolute; top:93% ; background-color:yellow">Return to Login Page</button>
            </div>
            
        </form>
       
    </body>
</html>


