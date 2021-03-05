 <?php
session_start();
        
if(isset($_POST['submit'])){
     
    if($_POST['username']=='admin' && $_POST['password']=='admin'){
        $_SESSION['userName'] = 'admin';
        echo "logging in";
        header("Refresh:3; url=mainpage.php");
        
    }
    else{
        echo "wrong username or password";
    }   
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
        </form>
       
    </body>
</html>


