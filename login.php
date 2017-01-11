<?php
session_start(); // Starting Session
require 'sql.php';
if (isset($_POST['submit'])) {

  if (empty($_POST['username']) || empty($_POST['password'])) {
    echo "Username or Password is empty, please provide input for both fields.";
  } else {
    // Define $username and $password
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // SQL query to fetch information of registered users and finds user match.
    $findPassword = "select Password from users where User Name = $username;";
    $getPassword = mysqli_query($conn,$findPassword);
    $sql = "select * from users where Password = '$password' AND UserName = '$username';"; // NOTE: took out this code just so i could check the rest of the pages ...checkPassword($password,$getPassword)
    
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
      $_SESSION['login_user'] = $username; // Initializing Session
      $aUser = mysqli_fetch_assoc($result); // get the user entry from database
      $_SESSION['user_firstname'] = $aUser['First Name'];
      $_SESSION['user_lastname'] = $aUser['Last Name'];
      $_SESSION['user_class'] = $aUser['Class'];
      $_SESSION['user_gender'] = $aUser['Gender'];
      $_SESSION['user_CWID'] = $aUser['CWID'];
      $_SESSION['user_admin'] = $aUser['Admin'];
      $_SESSION['user_kitchen'] = $aUser['Kitchen'];
      $_SESSION['user_laundry'] = $aUser['Laundry'];
      $_SESSION['user_specialneeds'] = $aUser['Special Needs'];
      if ($aUser['Admin']) {
        header("location: admin_main.php");
      } else {
        header("location: Page1.php"); // Redirecting To Other Page
      }
    } else { // no such login
      echo "Username or Password is invalid.";
    }

  }

}
?>