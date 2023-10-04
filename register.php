<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opencloud - Registreren</title>
</head>
<body>
    <h1>Registreren</h1>

    <?php
    // Controleer of er een foutbericht is ingesteld (bijvoorbeeld als de gebruikersnaam al bestaat)
    if(isset($_GET['error'])) {
        echo '<p style="color:red;">' . $_GET['error'] . '</p>';
    }
    ?>

    <form action="process_register.php" method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Herhaal wachtwoord:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <label for="email">E-mailadres:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Registreren">
    </form>
    <br>
    <a href="index.php">Terug naar login</a>
</body>
</html>
