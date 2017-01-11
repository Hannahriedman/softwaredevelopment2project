<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h3 class= "title">Marist Room Reservation Recommender</h3> 
    </head>
    <body> <?php
        session_start();
        //print_r($_SESSION);die;
        if ($_SESSION['user_admin']) {
            echo "<h1>Administrative Interface</h1>\n";
            echo "Welcome admin user ".$_SESSION['login_user'].", From here you can delete and insert information!\n<br>";
            echo "<BR>";
            echo "<a href=admin_users.php>Manage Users</a><br>\n";
            echo "<a href=admin_dorms.php>Manage Dorms</a><br>\n";
            echo "<a href=admin_reservations.php>Manage Reservations</a><br>\n";
            echo "<BR>";
        } else {
            header("location: index.php");
        }
        ?>
    </body>
</html>