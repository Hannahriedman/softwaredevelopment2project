<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h2 class= "title">Marist Room Reservation Recommender Account Creation</h2>
    </head>
    <body>
        <h3>Confirmation:</h3>
    <?php
        require 'sql.php';
        echo "UserName: ", $_POST[username], "<br><br>";
        echo "Password: ********** <br><br>";
        echo "First Name: " , $_POST[firstname],"<br><br>";
        echo "Last Name: " , $_POST[lastname],"<br><br>";
        echo "Gender: ", $_POST[gender], "<br><br>";
        echo "CWID: ", $_POST[cwid],"<br><br>";
        echo "Class: ", yearcalc($_POST[year]) ,"<br><br>";
        $special = checkPreference($_POST[preference]);
        $laundry = checkPreference($_POST[preference1]);
        $kitchen = checkPreference($_POST[preference2]);
        $password = $_POST[password];//password_hash($_POST[password], PASSWORD_DEFAULT);
        $year = $_POST[year];
        echo "Preferences: ", "<br>";
        if($special) echo "Special Needs", "<br>";
        if($laundry) echo "Laundry on Premise", "<br>";
        if($kitchen) echo "Fully Equiped Kitchen", "<br>";
        if(!$special && !$laundry && !$kitchen) echo "None","<br>";
        
        $user =  "INSERT INTO users
            VALUES ('$_POST[username]','$password', '0', '$_POST[firstname]','$_POST[lastname]','$_POST[gender]','$_POST[cwid]','$year','$kitchen','$laundry','$special');";
            
            mysqli_query($conn, $user); //Creates user account and adds associative information to users table
        ?> 
        Click the button below to be redirected to the login page
        <form action="index.php" method="post">
              <button type="sumbit">Login Here</button>
         </form>
    </body>
</html>