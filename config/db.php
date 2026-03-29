<?php

$conn = new mysqli(
    $_ENV['MYSQLHOST'],
    $_ENV['MYSQLUSER'],
    $_ENV['MYSQLPASSWORD'],
    $_ENV['MYSQLDATABASE']
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>