<?php
function searchItemByDescription($description) {
    require("config.php"); // Include your database configuration

    // Connect to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $description = $conn->real_escape_string($description); // Sanitize input to prevent SQL injection

    $sql = "SELECT * FROM fthings WHERE description LIKE '%$description%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Item ID: " . $row["id"]. " - Description: " . $row["discription"]. "<br>";
        }
    } else {
        echo "No items found with that description";
    }

    $conn->close();
}
?>
