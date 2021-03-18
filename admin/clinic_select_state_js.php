
<?php
if(isset($_POST['get_option'])){
    include_once 'admin_dbcon.php';

    $state = $_POST['get_option'];
    $find = $db_host->prepare('SELECT clinic_city from city_regions where clinic_state = :state');
    $find->bindParam(':state', $state);
    $find->execute();
    while($row = $find->fetch()){
        echo '<option>'.$row['clinic_city'].'</option>' ;
    }
    exit;
}
?>
</body>
</html>
