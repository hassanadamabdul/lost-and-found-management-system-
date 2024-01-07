<?php
require("config.php");
require("session.php");
require("functions.php");

if ($_POST['cata'] == "0") {
    header("location:found.php");
    exit(); // Add this line to prevent further execution
}

// User id
$ref_uid = $_SESSION['login_user'];

// Image id
$ref_imgid = upload_image("limage", "lost"); // Make sure upload_image() returns a valid image id

// Address id
$ref_add = add_adress($_POST); // Assuming there's a function named add_address

$catg = $_POST['cata'];
$discp = $_POST['discription'];
$date = $_POST['date'];
$pincode = $_POST['pincode'];

if ($ref_imgid == "fail") {
    header("location:lost.php");
    exit(); // Add this line to prevent further execution
} else {
    add_post($discp, $ref_add, $pincode, $ref_uid, $ref_imgid, $date, $catg, "lost");
    header("location:search.php?cat=$catg&&type=lost&&pdate=$date");
    exit(); // Add this line to prevent further execution
}
?>
