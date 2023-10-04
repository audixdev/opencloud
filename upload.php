<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bestanden</title>
</head>
<body>
    <h1>Upload Bestanden</h1>

    <?php
    session_start();

    // Controleer of de gebruiker is ingelogd
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
        $target_dir = "uploads/"; // Maak een map genaamd 'uploads' in dezelfde map als dit bestand
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.";
            $uploadOk = 0;
        }

        // Als $uploadOk gelijk is aan 0, upload het bestand niet
        if ($uploadOk == 0) {
            echo "Sorry, je bestand is niet geüpload.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "Het bestand ". htmlspecialchars( basename( $_FILES["file"]["name"])). " is geüpload.";
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
    <a href="home.php">Terug naar home</a>
</body>
</html>