<?php
session_start();

// Controleer of de gebruiker is ingelogd
if(isset($_SESSION['username'])) {
    // Verwijder de sessievariabele
    unset($_SESSION['username']);

    // Vernietig de sessie
    session_destroy();

    // Stuur de gebruiker terug naar de inlogpagina
    header('Location: login.php');
    exit();
} else {
    // Als de gebruiker niet is ingelogd, stuur ze dan naar de inlogpagina
    header('Location: login.php');
    exit();
}
?>
