<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fashionmarket"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>