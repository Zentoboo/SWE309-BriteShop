<?php
$servername = "YOUR_RDS_ENDPOINT_HERE";
$username = "YOUR_DB_USERNAME";
$password = "YOUR_DB_PASSWORD";
$dbname = "briteshop";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
