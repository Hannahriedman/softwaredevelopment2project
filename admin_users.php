<html>
    <head>
       <link rel="stylesheet" type="text/css" href="style.css">
       <h3 class= "title">Marist Room Reservation Recommender</h3>
       <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            tr:hover{background-color:#f5f5f5}
        </style>
    </head>
    <body>
    <?php
      session_start(); // Starting Session
      require 'sql.php';
      //print_r($_SESSION);die;
      if ($_SESSION['login_user']) {
        if ($_SESSION['user_admin']) {?>
        <table>
          <tr>
            <td>ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Class</td>
            <td>Gender</td>
            <td>Kitchen</td>
            <td>Laundry</td>
            <td>Special Needs</td>
            <td>Admin</td>
            <td></td>
            <td></td>
          </tr>
      <?php
          $sql = "select * from users";
          $result = mysqli_query($conn,$sql);
          while ($aRow = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$aRow['CWID']."</td>";
            echo "<td>".$aRow['First Name']."</td>";
            echo "<td>".$aRow['Last Name']."</td>";
            echo "<td>".$aRow['Class']."</td>";
            echo "<td>".$aRow['Gender']."</td>";
            echo "<td>".$aRow['Kitchen']."</td>";
            echo "<td>".$aRow['Laundry']."</td>";
            echo "<td>".$aRow['Special Needs']."</td>";
            echo "<td>".$aRow['Admin']."</td>";
            echo "<td>
                  <form action='admin_delete.php' method='post'>
                    <input type='hidden' value='user' name='lastpage'>
                    <input type='hidden' value=".$aRow['CWID']." name='CWID'>
                    <input type='submit' value='Delete' onclick=\"return confirm('Are you sure?');\">
                  </td>
                  </form>";
           // echo "<td><a href=admin_delete.php id=".$aRow['CWID']." onclick=\"return confirm('Are you sure?');\">Delete</a></td>\n"; // have to update this
            echo "</tr>";
          }
          echo "</table>\n";
          echo "<form action='admin_insert.php' method='post'>
                    <input type='hidden' value='user' name='lastpage'>
                    <input type='submit' value='Insert New Information'>
                </form>";
          //echo "<a href=admin_insert.php>Insert New Information</a><br>";
          echo "<a href=admin_main.php>Go Back</a><br>";
        } else {
            header('location:Page1.php?message=You%20do%20not%20have%20access%20to%20this%20admin%20page.');
        }
      } else { 
          header('location: index.php?message=You%20are%20not%20logged%20in.');
      }

    ?>
    </body>
</html>