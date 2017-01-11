<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h3 class= "title">Marist Room Reservation Recommender Account Creation</h3> 
    </head>
    <body>
        <?php
            require 'sql.php';
        ?>
            <form action="confirmation.php" method="post">
              Username:
              <input id="name" name="username" placeholder="Username" type="text"><br><br>
              Password:
              <input id="password" name="password" placeholder="**********" type="password"> <br><br> 
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
          <input type="submit" value="Submit">
        </form>
    </body>
</html>








