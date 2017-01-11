<?php session_start();
    require 'sql.php'; 
?>
<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h3 class= "title">Administrative Insert Interface</h3> 
    </head>
    <body>
        <?php
           if ($_SESSION['user_admin']) {
            $lastpage = $_POST['lastpage'];
            
             if ($lastpage == 'reservation') { 
                    
                $reservation = "INSERT INTO reservations
                VALUES ('$++IDInt', '$_POST[cwid]', '$_POST[residence]');"; //creates the reservation entry
                $result = mysqli_query($conn, $reservation);
                echo "CWID:".$_POST[cwid]." Confirmed in Residence Area: ".$_POST[residence];
                echo "<a href=admin_reservations.php>Go Back</a><br>\n";
                    
                } else if ($lastpage == 'dorm') { 
                    
                $special = checkPreference($_POST[preference]);
                $laundry = checkPreference($_POST[preference1]);
                $kitchen = checkPreference($_POST[preference2]);
                $year = $_POST[year];
                $dorm =  "INSERT INTO residence
                VALUES ('$++IDInt','$_POST[name]','$_POST[year]','5','5','$kitchen','$laundry','$special');";
                $result = mysqli_query($conn, $dorm);  
                echo $_POST[name]." was successfully added.";
                echo "<a href=admin_dorms.php>Go Back</a><br>\n";
                }
            
           } else {
                header("location: index.php");
            }
        ?>
    </body>
</html>