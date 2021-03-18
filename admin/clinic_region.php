<?php
require 'admin_dbcon.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="clinic_region.php" method="post">
        <h2>add state and city to add in the database</h2>

        <label>Enter State:</label>
        <input type="text" name="state" placeholder="Enter State" />
        <label>Enter City:</label>
        <input type="text" name='city' placeholder='Enter City' />
        <button type='submit' name="submit">Submit</button>
        <button style="float:right" type="submit" name="return"><b>Return to Mainpage</b></button>
    </form> 
    <?php
        if(isset($_POST['return'])){
            echo "back to mainpage";
            header('Refresh:0.5; url=mainpage.php');
        }
        if(isset($_POST['submit'])){
            $state = $_POST['state'];
            $city = $_POST['city'];

            $select_state = $db_host->prepare("select clinic_state from clinic_regions where clinic_state = :state");
            $select_state -> bindValue(':state', $state);
            $select_state->execute();
            if($select_state->rowCount() > 0){
                $select_city = $db_host->prepare("select clinic_city from clinic_regions where clinic_city = :city");
                $select_city->execute(array(':city' => $city));

                if($select_city->rowCount() > 0){
                    echo "the state and city already exists";
                    exit;
                }
                else{
                    $insert_q = $db_host->prepare("insert into clinic_regions(clinic_state, clinic_city) values (:state, :city)");
                    $insert_q -> execute(array(':state' => $state,
                                        ':city' => $city));
                    echo "City added successfully";
                }
                unset($select_state);
                unset($select_city);
                
                unset($insert_q);
                unset($db_host);
            }
            else{
                $insert_q = $db_host->prepare("insert into clinic_regions (clinic_state, clinic_city) values (:state, :city)");
                    $insert_q -> execute(array(':state' => $state,
                                        ':city' => $city));
                    echo "State and City added successfully";

                unset($select_state);
                unset($select_city);
                
                unset($insert_q);
                unset($db_host);
            }
        }
    ?>
</body>
</html>