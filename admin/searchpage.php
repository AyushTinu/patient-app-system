<?php
include "admin_dbcon.php";
session_start();
?>
   <html>
    <head>
        <title>a search function</title>
        
        <style>
            body, input{
                font-family: verdana;
            }
            button, label{
                font-weight: bold;
            }
            table, tr, th{
                border: 1px solid black;
            }
            td{
                border: 1px solid blue;
            }
        </style>   
        <script type="text/javascript" src="jquery.js"></script>
            <script type="text/javascript">
            function do_search(){
                var search_term = $("#search_term"):val();
                $.ajax({
                    type:'post',
                    url:'searchpage.php',
                    data:{
                        search:'search',
                        search_term:search_term
                    },
                    success: function(response){
                        document.getElementById("display-div").innerHTML = response;
                    }
                });
                return false;
            }
        </script>
    </head>
    <body>
      <div id="wrapper">
      <div id="search_box">
       <form method="post" action="searchpage.php" onsubmit="return do_search();">
           <label>Enter Patient name to search: </label><br>
           <input type="text" name="search_name" style="width : 400px" placeholder="Enter Name of the patient" onkeyup="do_search();">
           <button name="searchByName" type="submit" value="searchName">SEARCH Name</button>
            <input type="text" name="search_id" style="width: 200px" placeholder="Enter ID of patient">
           <button name="searchByid" type="submit" value="searchID">SEARCH ID</button>
            
            <br><br>
            <button name="return" type="submit">Return To Mainpage</button>
        

       </form>
        </div>
        <div id='display-div'>
            
        </div>
    </div>
        
    </body>
</html>

<?php
        
       
     if(isset($_POST['return'])){
            header("Refresh:0.5; url=mainpage.php");
            echo 'returning to the main page';
        }
        
        if(isset($_POST['searchByName'])){
            
            $search_val = $_POST['search_name'];
            if(!empty(trim($search_val)) && empty(trim($search_id))){   
                // echo "<br><br>enter any value then press the search button to search";
                $get_result = $db_host->prepare("select * from patient_account where patient_fname like :fname");
            // $get_result -> bindValue(':searchval', $search_val);
            if($get_result -> execute(array(':fname' => "%$search_val%"))){
            echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Full Name</th>";
                echo "<th>Username</th>";
                echo "<th>Complete Address</th>";
                echo "<th>Contact:</th>";
                echo "</tr>";
                while($row = $get_result->fetch()){
                    echo "<tr>";
                    echo "<td>".$row['patient_id'] . "</td>";
                    echo "<td>". $row['patient_fname']."</td>";
                    echo "<td>".$row['patient_username']."</td>";
                    echo "<td>".$row['patient_address']."</td>";
                    echo "<td>".$row['patient_phone']."</td>";
                }
            echo "</table>";
            }
            //exit();  
            }
            
            if(isset($_POST['searchByid'])){
                if(!empty(trim($search_id)) && empty(trim($search_val))){
                 
                    $search_id = $_POST['search_id'];
            
                    $get_resultid = $db_host->prepare("select * from patient_account where patient_id = :pid");
                    if($get_resultid -> execute(array(':pid' => "%$search_id%"))){
                        echo "<table>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Full Name</th>";
                        echo "<th>Username</th>";
                        echo "<th>Complete Address</th>";
                        echo "<th>Contact:</th>";
                        echo "</tr>";
                        while($row = $get_resultid->fetch()){
                            echo "<tr>";
                            echo "<td>".$row['patient_id'] . "</td>";
                            echo "<td>". $row['patient_fname']."</td>";
                            echo "<td>".$row['patient_username']."</td>";
                            echo "<td>".$row['patient_address']."</td>";
                            echo "<td>".$row['patient_phone']."</td>";
                        }
                        echo "</table>";
                    }
                    //exit();
            }
        }
        }
?>   