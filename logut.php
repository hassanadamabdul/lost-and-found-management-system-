<?php
/**
 * Created by PhpStorm.
 * User: nishan
 * Date: 03-10-2017
 * Time: 11:00 PM
 */

require("config.php");
session_start();

// Remove the line below, as it's not necessary for logout
// mysqli_commit($con);

// Check if the user is logged in before trying to destroy the session
if(isset($_SESSION['login_user'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("location: login.php");
} else {
    // If the user is not logged in, redirect to the login page directly
    header("location: login.php");
}
?>
