<!--Hannah Riedman and Marc Christensen -->
<?php session_start(); ?>
<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h3 class= "title">Marist Room Reservation Recommender</h3> 
    </head>
    <body>
        <?php
            require 'sql.php';
        
            $cwid = $_SESSION['user_CWID'];
            $reservation = "SELECT ID FROM reservations WHERE CWID= $cwid";
            $resultres = mysqli_query($conn,$reservation);
            if ($_POST['delete'] == 1) { // checks if delete button was sumbitted
                $getDorm = "SELECT RA FROM reservations WHERE CWID='$cwid';";
                $dormResult = mysqli_query($conn, $getDorm);
                $dormChoice = mysqli_fetch_row($dormResult);
                $sql = "DELETE FROM reservations WHERE CWID = $cwid;";
                mysqli_query($conn, $sql);
                $increment = "UPDATE residence SET Available = Available + 1 WHERE Name = '$dormChoice[0]'";
                mysqli_query($conn, $increment); // Increases availible slots of RA 
                echo "You have deleted the reservation<br><br>";
                echo "Click the button below to create a new reservation.<br><br>";
                echo "<a href=Page1.php>Go Back</a><br>";
            } else if (mysqli_num_rows($resultres)) { // checks to see if cwid already has reservation. If so then show option to delete it
                echo "You already have a reservation. Click the button below to delete it and create a new one.
                <br>Or Go Back to return to the previous page.";
                echo "<form action='Page1.php' method='post'>
                      <input type='hidden' value='1' name='delete'>
                      <input type='submit' onclick=\"return confirm('Are you sure?');\">
                      </form>
                      <a href=index.php>Go Back</a><br>";
            } else { // if user doesn't have a reservation yet, show choices to create one.
            $newReservation = true;
            $year = $_SESSION['user_class'];
            $name = $_SESSION['user_firstname'];
            echo "Please Choose Your Residence Hall Preference $name<br>"; 
            $sql = "SELECT name, available FROM residence where class = $year;"; // this is the SQL to get RA entries from database
                if ($result = mysqli_query($conn,$sql)) { 
                    $numRows = mysqli_num_rows($result); // determine how many rows(i.e., records) are returned
                    echo "<form action='Page2.php' method='post'>
                                <select name='residence'>\n
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
                     echo "</select>\n";
                }
            }

        if ($newReservation) {
        echo "<input type='submit' value='Submit'>
        </form>";
        }
    ?>
    </body>
</html> 