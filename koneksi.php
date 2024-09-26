<?php
$host = 'localhost'; // Ganti jika perlu
$username = 'root'; // Ganti jika perlu
$password = ''; // Ganti jika perlu
$dbname = 'pendidikan';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
