<?php

include "admin_dbcon.php";
?>
<html>
<head>
<title>add clinic</title>
    <script type="text/javascript" src="jquery.js"></script>
<!---
	
    <script>
        function selectState(val){
            $.ajax({
                type:'post',
                url:'clinic_select_state_js.php',
                data:'state'+val,
                success: function(data){
                    $('#state-list').html(data);
                }
            });
        }
    </script>
--->

<script type="text/javascript">
    function changeState(val){
        $.ajax({
            type: 'post',
            url: 'clinic_select_state_js.php',
            data: {
                get_option:val
            },
            success: function(response){
                document.getElementById("new_select").innerHTML = response;
            }
        });
    }
</script>
</head>
<body>
	<form action="clinic_add.php" method="post">
	    <h2>Add a New Clinic</h2>
	    Clinic ID: <input type="number" name="cid">
       <br>
       Clinic Name: <input type="text" name="cname">
       <br>
       Clinic Address: <input type="text" name="caddress">
       <br>
       Clinic State: <input type="text" name="cstate">
            <select name="crstate" onchange="changeState(this.value)">
           <option value="">Select States</option>
           <?php 
           include 'admin_dbcon.php';
           $state_query = $db_host -> prepare('SELECT distinct clinic_state FROM clinic_regions order by clinic_state asc');
           $state_query -> execute();
           while($row = $state_query -> fetch()){
               
            echo "<option>".$row['clinic_state']."</option>";
            
           }
           ?>
           </select>
        <br>
        Clinic City: <input type="text" name="ccity">
        <select name="crcity" id='new_select'>
            <option value="">Select City</option>
        </select>
       <br>
       Contact No.: <input type="number" name="ccontact">
       <br><br>
       <button type="submit" name="submit">Register</button>
        <button name="returnadmin"><b>Return to admin page</b></button>
	</form>
</body>
</html>

<?php
session_start();

if(isset($_POST['returnadmin'])){
    header("Refresh:1; url=mainpage.php");
    echo "loading please wait";
}


if(isset($_POST['submit'])){

    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
    $caddress = $_POST['caddress'];
    $cstate = $_POST['cstate'];
    $ccity = $_POST['ccity'];
    $contact = $_POST['ccontact'];
    
    if(empty($cid) && empty($cname) && empty($caddress) && empty($cstate) && empty($ccity) && empty($contact)){
        echo "There is a problem Please fill all the required fields...";
    }else{
    
    $query = "INSERT INTO `clinic`(`cid`, `clinic_name`, `clinic_address`, `clinic_state`, `clinic_city`, `clinic_contact`) 
                VALUES (:cid, :cname, :caddress, :cstate, :ccity, :ccontact)";
    
    $stmt = $db_host->prepare($query);
    if($stmt->execute(array(':cid'=>$cid, 
    ':cname'=>$cname, 
    ':caddress'=>$caddress, 
    ':cstate'=>$cstate, 
    ':ccity'=>$ccity,
    ':ccontact'=>$contact))){
        echo "<br>Clinic Registered successfylly";
            header("Refresh:1;url=mainpage.php");
    }
    
    unset($db_host);
    unset($stmt);
    }

}
?>
