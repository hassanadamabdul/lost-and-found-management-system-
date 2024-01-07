

<?php
require("config.php"); // Make sure to include your database connection configuration
require ("session.php");
require ("config.php");
require ("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user details from the form
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security

    // Insert user details into the database
    $query = "INSERT INTO users (email, first_name, last_name, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters to the query
    mysqli_stmt_bind_param($stmt, "ssss", $email, $first_name, $last_name, $password);

    // Execute the query
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if ($result) {
        echo "User added successfully!";
    } else {
        echo "Error adding user: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($conn);
}
?>
