<?php
include 'db.php'; // Inclusief het databasebestand om de verbinding te maken

// Haal de gegevens op uit het registratieformulier
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Voer eventuele extra validaties uit

// Hash het wachtwoord voordat het wordt opgeslagen
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Voeg de gebruiker toe aan de database
$sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Registratie succesvol!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); // Sluit de databaseverbinding
?>
