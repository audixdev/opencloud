<?php
include 'db.php';

if(isset($_GET['code'])) {
    $short_code = $_GET['code'];

    // Zoek de originele URL bij de korte code
    $sql = "SELECT original_url FROM links WHERE short_code = '$short_code'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $original_url = $row['original_url'];

        // Stuur de gebruiker door naar de originele URL
        header("Location: $original_url");
        exit();
    } else {
        echo "Deze korte URL is niet gevonden.";
    }
} else {
    echo "Geen korte code ontvangen.";
}
?>
