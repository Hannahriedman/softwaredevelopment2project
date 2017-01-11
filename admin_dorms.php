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
        session_start();
        require 'sql.php';
        //print_r($_SESSION);die;
        if ($_SESSION['user_admin']) {
            echo "<h1>Manage Dorms</h1>\n";
            ?>
             <table>
              <tr>
              <td>ID</td>
              <td>Name</td>
              <td>Class</td>
              <td>Capacity</td>
              <td>Available</td>
              <td>Kitchen</td>
              <td>Laundry</td>
              <td>Special Needs</td>
              <td></td>
              <td></td>
            </tr>
        <?php
            $sql = "select * from residence ORDER BY ID asc";
            $result = mysqli_query($conn,$sql);
            while ($aRow = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              //print_r($aRow);
              echo "<td>".$aRow['ID']."</td>";
              echo "<td>".$aRow['Name']."</td>";
              echo "<td>".$aRow['Class']."</td>";
              echo "<td>".$aRow['Capacity']."</td>";
              echo "<td>".$aRow['Available']."</td>";
              echo "<td>".$aRow['Kitchen']."</td>";
              echo "<td>".$aRow['Laundry']."</td>";
              echo "<td>".$aRow['Special Needs']."</td>";
              echo "<td>
                    <form action='admin_delete.php' method='post'>
                      <input type='hidden' value='dorm' name='lastpage'>
                      <input type='hidden' value=".$aRow['ID']." name='ID'>
                      <input type='submit' value='Delete' onclick=\"return confirm('Are you sure?');\">
                    </td>
                    </form>";
             // echo "<td><a href=admin_delete.php?id=".$aRow['CWID'].">Delete</a></td>\n";
              echo "</tr>";
            }
            echo "</table>\n";
            echo "<form action='admin_insert.php' method='post'>
                      <input type='hidden' value='dorm' name='lastpage'>
                      <input type='submit' value='Insert New Dorm'>
                  </form>";
            echo "<a href=admin_main.php>Go Back</a><br>";
            echo "<BR>";
        } else {
            header("location: index.php");
        }
    ?>
    </body>
</html>