<?php
$host = 'localhost';
$database = 'proj';
$username = 'root';
$password = '120090086';
$mysqli = new mysqli($host, $username, $password, $database);
if (mysqli_connect_errno()) {
    // 诊断连接错误
    die("could not connect to the database.\n" . mysqli_connect_error());
}