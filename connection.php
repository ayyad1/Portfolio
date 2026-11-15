<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "portfolio_db";



$conn = new mysqli($host, $user, $password, $dbname);



if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>