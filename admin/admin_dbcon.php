<?php 
$server = "localhost";
$id = "root";
$pass = "";
$db_name = "training_1";

try{
    $db_host = new PDO("mysql:host=$server; dbname=$db_name",$id , $pass);
    $db_host->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(empty($db_host)){
        echo "some error occured while connecting<br><br>";
    }
    else{
        echo "connection successful <br><br>";
    }
}
catch(PDOException $e){
    echo "some error occured";
}
?>