<?php
$servername = "localhost"; // Change this if your MySQL server is on a different host
$username = "drose"; // Replace with your MySQL username
$password = "cp476dhar"; // Replace with your MySQL password
$dbname = "cp476"; // Replace with the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully"; // This message will be displayed in the browser if the connection is successful.

// Close the connection when you're done.
$conn->close();
?>