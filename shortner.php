<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Shortener</title>
    <link rel="icon" type="image/x-icon" href="/opencloud/opencloud/logo/icon.png" />
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label, input {
            display: block;
            margin: 10px auto;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        input[type="submit"] {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a.button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        a.button:hover {
            background-color: #0056b3;
        }
    </style>
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
            $user_id = $_SESSION['user_id']; // Voeg deze regel toe om de user_id op te halen

            // Genereer een willekeurige string van 6 tekens
            $short_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

            // Voeg de korte URL toe aan de database
            $sql = "INSERT INTO links (original_url, short_code, user_id) VALUES ('$original_url', '$short_code', '$user_id')"; // Voeg user_id toe aan de query
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
    <a href="index.php" class="button">Terug naar home</a>
</body>
</html>