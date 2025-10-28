<?php
// Database connection (update with actual credentials)
$host = 'localhost';
$dbname = 'u138823229_cozy_cup';
$username = 'u138823229_admin';
$password = 'Cmpe272@sjsu';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
