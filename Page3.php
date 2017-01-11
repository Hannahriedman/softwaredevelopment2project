<!--Hannah Riedman and Marc Christensen -->
 <?php session_start(); ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <h3 class= "title">Marist Room Reservation Recipt</h3>
    </head>
    <body>
    <div class= "results2">
        <?php 
        require 'sql.php';?>
        First Name: <?php echo $_SESSION['user_firstname']; ?> <br><br>
        Last Name:  <?php echo $_SESSION['user_lastname']; ?> <br><br>
        Gender: <?php echo $_SESSION['user_gender']; ?> <br><br>
        CWID: <?php echo $_SESSION['user_CWID']; ?> <br><br>
        Class: <?php echo yearcalc($_SESSION['user_class']); ?> <br><br>
        Preferences:<br>
        <?php 
            if($_SESSION['user_specialneeds'] != null) echo "Special Needs", "<br>";
            if($_SESSION['user_laundry'] != null) echo "Laundry on Premise", "<br>";
            if($_SESSION['user_kitchen'] != null) echo "Fully Equiped Kitchen", "<br>";
            if($_SESSION['user_kitchen'] == null && $_SESSION['user_laundry'] == null && $_SESSION['user_specialneeds'] == null) echo "None","\n<br><br>";?><br>
       Residence Hall: <br><?php echo $_POST[residence]; ?> <br><br>
       <?php
       $cwid = $_SESSION['user_CWID'];
       $reservation = 
       "INSERT INTO reservations
       VALUES ('$++IDInt', '$cwid', '$_POST[residence]');"; //creates the reservation entry
       mysqli_query($conn, $reservation);
       $last_id = mysqli_insert_id($conn); //gets the reservation number of newest reservation

       $decrementAvaiable = 
       "UPDATE residence
       SET Available = Available - 1
       WHERE Name ='$_POST[residence]';"; //reduce available slots in residence area by one for next time
       mysqli_query($conn, $decrementAvaiable);  
       echo "Your Reservation Number is: $last_id" ;
       ?>
    </div>
    <img src="Marist.jpg"></img>
    </body>
</html>
