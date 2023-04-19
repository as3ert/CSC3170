<?php
// Configuration file for the database connection
$host = 'localhost';
$database = 'proj';
$username = 'root';
$password = '4223';
$mysqli = new mysqli($host, $username, $password, $database);

// If the connection fails, report an error
if (mysqli_connect_errno()) {
    die("could not connect to the database.\n" . mysqli_connect_error());
}