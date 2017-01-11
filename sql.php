<?php
            $servername = "localhost";
            $username = "marcoror150";
            $password = "";
            
            // Create connection
            $conn = mysqli_connect($servername, $username, $password);
            
            mysqli_select_db($conn,"radatabase");
            mysqli_query($conn,"use radatabase");

            $getLargestID = "SELECT LAST_INSERT_ID()";
            $IDFind = mysqli_query($conn, $getLargestID);
            $row = mysqli_fetch_assoc($IDFind);
            $ID = $row[ID];
            
            function yearcalc($year) {
                if ($year==1) {
                    return "Freshmen";
                } else if ($year==2) {
                    return "Sophmore";
                } else if ($year ==3){
                    return "Junior/Senior";
                } 
            }
            
            function checkPreference($preference) { //function to see if preferences are set

                if($preference != null) {
                    return true;
                } else {
                    return false;
                }
            }
?>