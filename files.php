<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloudsite - Mijn Bestanden</title>
</head>
<body>
    <h1>Mijn Bestanden</h1>

    <?php
    session_start();

    include 'db.php';

    // Controleer of de gebruiker is ingelogd
    if(isset($_SESSION['username'])){
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM files WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $filename = $row['filename'];
                $file_path = 'uploads/' . $filename;
                $file_link = $_SERVER['HTTP_HOST'] . '/opencloud/opencloud/' . $file_path; // Aanpassen aan je eigen pad

                echo "<p><a href='$file_link' target='_blank'>$filename</a></p>";
            }
        } else {
            echo "Er zijn geen bestanden geüpload.";
        }
    } else {
        header('Location: login.php');
        exit();
    }
    ?>

    <br>
    <a href="home.php">Terug naar home</a>
</body>
</html>
