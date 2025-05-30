<?php
// Database connection details
$host = 'peoplenpartners.net'; // Replace with your database host
$username = 'root'; // Replace with your database username
$password = 'RootP@ssw0rd'; // Replace with your database password
$database = 'ppicis_db'; // Replace with your database name

// Attempt to connect to the database
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}