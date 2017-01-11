<?php
if(isset($_SESSION['login_user'])){
header("location: Page1.php");
die;
}
?>
<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h3 class= "title">Marist Room Reservation Recommender</h3> 
    </head>
    <body>
        <h2>Login Form</h2>
        <h3>If you have an account already, please login below</h3>
          <form action="login.php" method="post">
            <label>UserName :</label>
            <input id="name" name="username" placeholder="username" type="text">
            <label>Password :</label>
            <input id="password" name="password" placeholder="**********" type="password">
            <input name="submit" type="submit" value="Login ">
          </form>
          If you don't have an account yet, click the button below to create one.
          <form action="signup.php" method="post">
              <button type="sumbit" >Sign up Here</button>
          </form>
          
          
    </body>
</html>