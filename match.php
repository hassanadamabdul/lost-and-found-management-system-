<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/main.css">

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/mainx.js"></script>
    <style>
        .postcard {
            margin-left: 20px;
            margin-right: 20px;
            border-radius: 20px;

        }


    </style>
</head>
<body class="grey darken-1">
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


require("config.php");
require("functions.php");
session_start();
if (!(isset($_SESSION['login_user']))) {
    header("location:login.php");
}
$user = $_SESSION['login_user'];

// Fetch lost items
$sqlLost = "SELECT * FROM lthings";
$resultLost = mysqli_query($conn, $sqlLost);

if ($resultLost) {
    while ($rowLost = mysqli_fetch_assoc($resultLost)) {
        $lostDescription = $rowLost['discription'];
        $lostCategory = $rowLost['cat_ref'];
        
        // Query the database for matching found items
      //  $sqlFound = "SELECT * FROM fthings WHERE discription LIKE '%" . $lostDescription . "%' AND cat_ref='" . $lostCategory . "'";
      $sqlFound = "SELECT * FROM fthings WHERE discription LIKE ? AND cat_ref=?";
      $stmt = mysqli_prepare($conn, $sqlFound);
      
      if ($stmt) {
          // Bind parameters
          mysqli_stmt_bind_param($stmt, "ss", $likePattern, $lostCategory);
          
          // Set parameter values
          $likePattern = "%" . $lostDescription . "%";
      
          // Execute statement
          mysqli_stmt_execute($stmt);
      
          // Get result
          $resultFound = mysqli_stmt_get_result($stmt);
      
          // Process result
          if ($resultFound) {
              // ... (your existing code for processing the result)
          } else {
              echo "Error: " . mysqli_stmt_error($stmt);
          }
      
          // Close statement
          mysqli_stmt_close($stmt);
      } else {
          echo "Error: " . mysqli_error($conn);
      }
        


        if ($resultFound) {
            if (mysqli_num_rows($resultFound) > 0) {
                echo '<div class="container center-align">';
                echo "<h4>Matching Found Items for Lost Item: $lostDescription</h4>";
                while ($rowFound = mysqli_fetch_assoc($resultFound)) {
                    // Display the found items
                    echo "Item Name: " . $rowFound['discription'] . "<br>";
                    echo "User Email: " . $rowFound['uemail'] . "<br>";
                    echo "Date Found: " . $rowFound['postdate'] . "<br>";
                    
                    echo "<hr>";
                }
                echo '</div>';
            } else {
                echo '<div class="container center-align">No matching found items for Lost Item: ' . $lostDescription . '</div>';
            }
        } else {
            echo "Error: " . mysqli_error($conn); // Display the error message
        }
    }
} else {
    echo "Error: " . mysqli_error($conn); // Display the error message
}

?>
</body>
</html>
