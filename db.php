<?php
$servername = "localhost"; // Verander dit naar de juiste servernaam indien nodig
$username = "root"; // Verander dit naar de gebruikersnaam van je database
$password = ""; // Verander dit naar het wachtwoord van je database (indien ingesteld)
$dbname = "opencloud"; // Verander dit naar de naam van je database

// Maak een verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer of de verbinding succesvol is
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
