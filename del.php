<?php
require("config.php");
require("session.php");
require("functions.php");

if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];
    global $conn;

    // Check if the user has the necessary permissions (optional)
    // You may want to implement additional checks here based on your requirements

    if ($type == "lost") {
        $table = "lthings";
    } else {
        $table = "fthings";
    }

    // Delete the item
    $sqlDelete = "DELETE FROM $table WHERE id=?";
    $stmtDelete = mysqli_prepare($conn, $sqlDelete);

    if ($stmtDelete) {
        // Bind parameters
        mysqli_stmt_bind_param($stmtDelete, "i", $id);

        // Execute statement
        mysqli_stmt_execute($stmtDelete);

        // Close statement
        mysqli_stmt_close($stmtDelete);

        // Display success message
        $successMessage = "Item successfully deleted!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect to the appropriate page if the necessary parameters are not set
    header("location:index.php"); // Change to the appropriate page
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Your existing head content here -->
</head>
<body>
    <!-- Your existing body content here -->
    
    <?php
        if (isset($successMessage)) {
            echo '<div class="container center-align green-text text-darken-2">';
            echo $successMessage;
            echo '</div>';
        }
    ?>
</body>
</html>
