<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
<body class="   grey darken-2">

<?php
require("config.php");
require("functions.php");
session_start();
if (!(isset($_SESSION['login_user']))) {
    header("location:login.php");

}
if($_SERVER['REQUEST_METHOD']=="GET"){
    $searchQuery = $_GET['searchFoundItem'];
   // $user=$_SESSION['login_user'];
   // $type=$_GET['type'];
  //  $cat=$_GET['cat'];
   // $pdate=$_GET['pdate'];


    $sql = "SELECT * FROM fthings WHERE discription LIKE '%$searchQuery%'";
    $retval = mysqli_query($conn, $sql);
}else{
    header("location:profile.php");
}
?>

<nav class="  blue-grey darken-3 z-depth-2" style="text-transform:">
    <div class="nav-wrapper  ">

        <a href="index.php" class="brand-logo " style="margin-left: 20px;text-transform: uppercase;">Lost And Found</a>
        <ul class="right hide-on-med-and-down">

            <!--<li><a href="about.php">About</a></li>-->
            <?php if (is_admin()) {
                echo " <li><a href=\"admin.php\" class=\" white-text btn \">ADMIN PANEL</a></li>";
            } ?>
            <li><a href="profile.php" class=" btn  white-text ">PROFILE</a></li>
            <li><a href="logut.php" class="btn  white-text ">LOGOUT</a></li>

        </ul>

    </div>
</nav>
<style>
    .row {
        margin-bottom: 0px;
    }
    .xx{
        overflow-y:scroll;
        max-height:400px;
        display:block;
    }
</style>
<?php



     
    if ($retval) { // Check if the query was successful
        if (mysqli_num_rows($retval) > 0) {
            echo '<div class="container center-align">';
            while ($row = mysqli_fetch_assoc($retval)) {
                echo"<hr>";
                // Display the found items
                echo "Item Name: " . $row['discription'] . "<br>";
                echo "Date Lost:" .$row['postdate'] ."<br>";
                // Add more details as needed
                echo "<hr>";
            }
            echo '</div>';
        } else {
            echo '<div class="container center-align">No matching items found.</div>';
        }
    } else {
        echo "Error: " . mysqli_error($conn); // Display the error message
    }

?>
        </tbody>
    </table>
</div>
</div>

</body>

</html>