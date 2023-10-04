<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bestanden</title>
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

        input[type="file"] {
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
    <h1>Upload Bestanden</h1>

    <?php
    session_start();

    include 'db.php';

    // Controleer of de gebruiker is ingelogd
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Controleer of het bestand al bestaat
        if (file_exists($target_file)) {
            echo "Sorry, het bestand bestaat al.";
            $uploadOk = 0;
        }

        // Controleer de bestandsgrootte (hier beperkt tot 5 MB)
        if ($_FILES["file"]["size"] > 5000000) {
            echo "Sorry, je bestand is te groot.";
            $uploadOk = 0;
        }

        // Toegestane bestandstypen (hier alleen afbeeldingen)
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
            $uploadOk = 0;
        }

        // Als $uploadOk gelijk is aan 0, upload het bestand niet
        if ($uploadOk == 0) {
            echo "Sorry, je bestand is niet geüpload.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // Voeg het bestand toe aan de database
                $filename = basename($_FILES["file"]["name"]);
                $user_id = $_SESSION['user_id'];

                $sql = "INSERT INTO files (user_id, filename) VALUES ('$user_id', '$filename')";
                if ($conn->query($sql) === TRUE) {
                    echo "Het bestand ". htmlspecialchars($filename). " is geüpload en opgeslagen in de database.";
                } else {
                    echo "Fout bij het opslaan van het bestand in de database: " . $conn->error;
                }
            } else {
                echo "Sorry, er was een probleem met het uploaden van het bestand.";
            }
        }
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        Selecteer bestand om te uploaden:
        <input type="file" name="file" id="file" required>
        <input type="submit" value="Upload Bestand" name="submit">
    </form>

    <br>
    <a href="index.php" class="button">Terug naar home</a>
</body>
</html>
