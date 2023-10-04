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
        $user_id = $_SESSION['user_id']; // Zet $user_id nadat de gebruiker is ingelogd

        $sql = "SELECT original_url, short_code FROM links WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $original_url = $row['original_url'];
                    $short_code = $row['short_code'];

                    $short_url = $_SERVER['HTTP_HOST'] . '/opencloud/opencloud/short.php?code=' . $short_code;

                    echo "<p>Originele URL: $original_url</p>";
                    echo "<p>Korte URL: <a href='$short_url' target='_blank'>$short_url</a></p>";
                }
            } else {
                echo "Er zijn geen korte URLs beschikbaar.";
            }
        } else {
            echo "Fout bij het uitvoeren van de query: " . $conn->error;
        }
    } else {
        header('Location: login.php');
        exit();
    }
    ?>

    <br>
    <a href="index.php">Terug naar home</a>
</body>
</html>
