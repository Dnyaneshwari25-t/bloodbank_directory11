<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "bloodbank";
$port = 3307; // MySQL port

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
