<?php
$servername = "localhost";
$username = "amzarine_appsg1";
$password = "appsg1&VdU@3941";
$database = "amzarine_appsg1";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>