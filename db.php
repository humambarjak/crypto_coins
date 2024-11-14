<?php
$servername = "localhost";
$username = "root";  // Vervang dit met jouw MySQL-gebruikersnaam
$password = "";      // Vervang dit met jouw MySQL-wachtwoord
$dbname = "bookwebsite";

// Verbinding maken
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
