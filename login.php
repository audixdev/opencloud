<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloudsite - Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php
    session_start();

    include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username; // Sla de gebruikersnaam op in de sessie
                header('Location: index.php'); // Stuur de gebruiker door naar home.php
                exit();
            } else {
                header('Location: login.php?error=Incorrecte wachtwoord');
                exit();
            }
        } else {
            header('Location: login.php?error=Gebruiker niet gevonden');
            exit();
        }
    }

    $conn->close();
    ?>

    <form action="" method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" value="Login">
    </form>
    <br>
    <a href="register.php">Registreer een nieuw account</a>
</body>
</html>
