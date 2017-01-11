<?php session_start();
    require 'sql.php'; 
?>
<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h3 class= "title">Administrative Insert Interface</h3> 
    </head>
    <body>
        <?php // this page checks what kind of insert the admin is doing (user,reservation or dorm)
             // Then it shows the proper form and checks for needed data and confims new info added
            
           if ($_SESSION['user_admin']) {
            $lastpage = $_POST['lastpage'];

            if ($lastpage == 'user') { 
                if ($_POST[firstname] == '') { ?>
            <form action="admin_insert.php" method="post">
              Username:
              <input id="name" name="username" type="text"><br><br>
              Password:
              <input id="password" name="password" type="password"> <br><br> 
              First name:
              <input type="text" name="firstname"><br><br>
              Last name:
              <input type="text" name="lastname"><br><br>
              Gender:<br>
              <input type="radio" name="gender" value="Male">Male<br>
              <input type="radio" name="gender" value="Female">Female<br>
              <input type="radio" name="gender" value="Other">Other<br><br>
              CWID:<br>
              <input type="text" name ="cwid"><br><br>
              Class:<br>
              <input type="radio" name="year" value="1">Freshman<br>
              <input type="radio" name="year" value="2">Sophmore<br>
              <input type="radio" name="year" value="3">Junior<br>
              <input type="radio" name="year" value="3">Senior<br>
              <br>Preferences:<br>
          <input type="checkbox" name="preference" value="Special Needs">Special Needs<br>
          <input type="checkbox" name="preference1" value="Laundry on Premise">Laundry on Premise<br>
          <input type="checkbox" name="preference2" value="Fully Equipped Kitchen">Fully Equipped Kitchen<br><br>
          <input type='hidden' value='user' name='lastpage'>
          <input type="submit" value="Submit">
        </form>
        <?php
                } else {
                    $special = checkPreference($_POST[preference]);
                    $laundry = checkPreference($_POST[preference1]);
                    $kitchen = checkPreference($_POST[preference2]);
                    $year = $_POST[year];
                    $user =  "INSERT INTO users
                    VALUES ('$_POST[username]','$_POST[password]','0', '$_POST[firstname]','$_POST[lastname]','$_POST[gender]','$_POST[cwid]','$year','$kitchen','$laundry','$special');";
            
                    $result = mysqli_query($conn, $user);
                    echo $_POST[firstname]." ".$_POST[lastname]." was successfully added.";
                    echo "<a href=admin_users.php>Go Back</a><br>\n";
                }
                
            } else if ($lastpage == 'reservation') { 
                if ($_POST['cwid'] == '') { ?>
            <form action="admin_insert.php" method="post">
              CWID:
              <input type="text" name ="cwid"><br><br>
              <input type='hidden' value='reservation' name='lastpage'>
              <input type='submit' value='Submit'>
            </form>
        <?php
                } else {
                    $cwid = $_POST['cwid'];
                    $sql = "SELECT class FROM users WHERE CWID='$cwid';";
                    $result = mysqli_query($conn,$sql);
                    
                    if (mysqli_num_rows($result) == 1) { // check to make sure cwid has user asscoiated with it
                        $reservation = "SELECT ID FROM reservations WHERE CWID='$cwid'";
                        $resultres = mysqli_query($conn,$reservation);
                        
                        if (!mysqli_num_rows($resultres)) { // checks to see if cwid already has reservation
                            $info = mysqli_fetch_assoc($result);
                            $class = $info['class'];
                            $sql = "SELECT name, available FROM residence WHERE Class='$class'; "; 
                            $result = mysqli_query($conn, $sql);
                            $numRows = mysqli_num_rows($result); 
                            echo "<form action='admin_confim.php' method='post'>
                                    <select name=residence>\n
                                    <option value='none'>Select housing preference</option> ";
                            for ($i=0; $i<$numRows; $i++) { // go through each record one by one
                                $dorm = mysqli_fetch_assoc($result); // get the next RA entry
                                $dormName = $dorm['name'];
                                $dormAvailable = $dorm['available'];
                                if ($dormAvailable > 0){
                                    echo "<option value='$dormName'>$dormName ($dormAvailable)</option>\n";
                                } else {
                                    echo "<option value='$dormName' disabled>$dormName ($dormAvailable)</option>\n";
                                }
                        
                            }
                            echo "</select>\n
                                <input type='hidden' value='reservation' name='lastpage'>
                                <input type='hidden' value='$_POST[cwid]' name='cwid'>
                                <input type='submit' value='Submit'>
                            </form>";
                        } else {
                            echo "You have already created a reservation for that user. Please delete reservation and try again.";
                            echo "<a href=admin_reservations.php>Go Back to Reservations</a><br>\n";
                        }
                    } else {
                        echo "Sorry, you must first create a user with CWID:".$cwid." Before creating a reservation.";
                        echo "<a href=admin_users.php>View Users page to create user</a><br>\n";
                        echo "<a href=admin_reservations.php>Go Back to Reservations</a><br>\n";
                    }
                }
            
            } else if ($lastpage == 'dorm') { ?>
               <form action="admin_confim.php" method="post">
                  Name:
                  <input id="password" name="name" type="text"> <br><br> 
                  Class:<br>
                  <input type="radio" name="year" value="1">Freshman<br>
                  <input type="radio" name="year" value="2">Sophmore<br>
                  <input type="radio" name="year" value="3">Junior<br>
                  <input type="radio" name="year" value="3">Senior<br>
                  <br>Preferences:<br>
                  <input type="checkbox" name="preference" value="Special Needs">Special Needs<br>
                  <input type="checkbox" name="preference1" value="Laundry on Premise">Laundry on Premise<br>
                  <input type="checkbox" name="preference2" value="Fully Equipped Kitchen">Fully Equipped Kitchen<br><br>
                  <input type='hidden' value='dorm' name='lastpage'>
                  <input type="submit" value="Submit">
            </form> 
        <?php  }
            
           } else {
                header("location: index.php");
             }
        ?>
    </body>
</html>