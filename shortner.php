<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Shortener</title>
</head>
<body>
    <h1>Link Shortener</h1>

    <?php
    session_start();

    include 'db.php';

    // Controleer of de gebruiker is ingelogd
    if(isset($_SESSION['username'])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $original_url = $_POST['url'];

            // Genereer een willekeurige string van 6 tekens
            $short_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

            // Voeg de korte URL toe aan de database
            $sql = "INSERT INTO links (original_url, short_code) VALUES ('$original_url', '$short_code')";
            if ($conn->query($sql) === TRUE) {
                $short_url = $_SERVER['HTTP_HOST'] . '/opencloud/opencloud/short.php?code=' . $short_code;
                echo "Korte URL: <a href='$short_url' target='_blank'>$short_url</a>";
            } else {
                echo "Fout bij het toevoegen van de korte URL: " . $conn->error;
            }
        }
    } else {
        header('Location: login.php');
        exit();
    }
    ?>

    <form action="" method="post">
        <label for="url">Originele URL:</label>
        <input type="text" id="url" name="url" required><br><br>
        
        <input type="submit" value="Shorten">
    </form>

    <br>
    <a href="index.php">Terug naar home</a>
</body>
</html>
