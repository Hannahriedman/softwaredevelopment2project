<!--Hannah Riedman and Marc Christensen -->
<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h3 class= "title">Marist Room Reservation Recommender</h3> 
    </head>
    <body>
    <div class= "results">
        <?php
            session_start();
            require 'sql.php';

            echo "<form action='Page3.php' method='post'>";
            echo "First Name: " , $_SESSION['user_firstname'],"<br><br>";
            echo "Last Name: " , $_SESSION['user_lastname'],"<br><br>";
            echo "Gender: ", $_SESSION['user_gender'], "<br><br>";
            echo "CWID: ",$_SESSION['user_CWID'],"<br><br>";
            echo "Class: ",yearcalc($_SESSION['user_class']),"<br><br>";
            $special = checkPreference($_SESSION['user_specialneeds']);
            $laundry = checkPreference($_SESSION['user_laundry']);
            $kitchen = checkPreference($_SESSION['user_kitchen']);
            echo "Preferences: ", "<br>";
            if($special) echo "Special Needs", "<br>";
            if($laundry) echo "Laundry on Premise", "<br>";
            if($kitchen) echo "Fully Equiped Kitchen", "<br>";
            if(!$special && !$laundry && !$kitchen) echo "None","<br>";
            echo "<br>Residence Hall: ", $_POST[residence],"<br><br>";
            $residenceChoice = $_POST[residence];
            $year = $_SESSION['user_class'];
        
             if ($residenceChoice != "none") { // check against user preferences
                $sql = "SELECT * FROM residence where name = '$residenceChoice'";
                
                if ($result = mysqli_query($conn, $sql)) {
                    $aDorm = mysqli_fetch_assoc($result); // get the RA entry that user picked
                    if ($aDorm['Class'] == $year) { 
                        if ($kitchen) {
                            if ($aDorm['Kitchen']) {
                                unset($errorString);
                            } else {
                                $errorString = "$residenceChoice does not provide kitchen facilities.\n
                                                Please go back and chose again.<br>";
                            }
                        } if ($laundry)  {
                             if ($aDorm['Laundry']) {
                                unset($errorString);
                             } else {
                                $errorString = "$residenceChoice does not provide laundry facilities.\n
                                                Please go back and chose again.<br>";
                            }
                         } 
                    }

                } else {
                    echo "Something went wrong in getting Residence Area details from database.".mysqli_error($conn); die;
                }

            }
            
            if (!$errorString) {
                form();
            } else {
                echo $errorString;
            }
            
            function form() {
               echo "<form action='Page3.php' method='post'>
                         <input type='hidden' name='residence' value='$_POST[residence]'>
                         <input type='submit' value='Submit'>
                     </form>";
            }
                 
        ?> 
    </div>
    </body>
</html>