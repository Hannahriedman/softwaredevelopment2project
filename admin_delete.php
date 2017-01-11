<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h3 class= "title">Administrative Delete Interface</h3> 
    </head>
    <body>
    <?php
        session_start();
        require 'sql.php';
        //print_r($_SESSION);die;
        if ($_SESSION['user_admin']) {
            
            $lastpage = $_POST['lastpage']; // this tells us what kind of info the admin wants to delete
            
            if ($lastpage == 'user') { // want to delete user
                $user = $_POST['CWID'];
                echo "This is the user cwid: ". $user . "<br><br>";
                $sql = "DELETE FROM users WHERE CWID = $user";
                echo "You have deleted the user<br>";
                echo "<a href=admin_users.php>Go Back</a><br>\n";
            } else if ($lastpage == 'reservation') { // want to delete reservation 
                $reservation = $_POST['ID'];
                $dormChoice = $_POST['RA'];
                echo "This is the reservation id: ". $reservation . "<br><br>";
                $sql = "DELETE FROM reservations WHERE ID = $reservation;";
                $increment = "UPDATE residence SET Available = Available + 1 WHERE Name = $dormChoice;";
                mysqli_query($conn, $increment); // Increases availible slots of RA 
                echo "You have deleted the reservation<br>";
                echo "<a href=admin_reservations.php>Go Back</a><br>\n";
            } else if ($lastpage == 'dorm') { // want to delete dorm
               $dorm = $_POST['ID'];
               echo "This is the dorm id: ". $dorm . "<br><br>";
               $sql = "DELETE FROM residence WHERE ID = $dorm;";
               echo "You have deleted the Dorm<br>";
               echo "<a href=admin_dorms.php>Go Back</a><br>\n";
            }
            
            $result = mysqli_query($conn,$sql);
            echo "<a href=admin_main.php>Go back to Main Page</a><br>";
            echo "<BR>";
        } else {
            header("location: index.php");
        }
    ?>
    </body>
</html>