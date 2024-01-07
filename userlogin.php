<?php
/**
 * Created by hassan
 * 
 * Date: 03-10-2023
 * Time: 09:01 PM
 */

session_start();
require("config.php");
require("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password for comparison
    $hashed_password = md5($password);

    $sql = "SELECT * FROM user WHERE email = '$email' and password='$hashed_password' ";
    $retval = mysqli_query($conn, $sql);

    if (!$retval) {
        die('Error in SQL query: ' . mysqli_error($conn));
    }

    $count = mysqli_num_rows($retval);

    if ($count == 1) {
        $_SESSION['login_user'] = $email;

        if (is_admin()) {
            header("location: admin.php");
        } else {
            header("location: index.php");
        }
    } else {
        header("location: login.php?login=0");
    }
} else {
    header("location: login.php?login=x");
}
?>
