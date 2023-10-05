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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
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

    
    if(isset($_SESSION['username'])){
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT original_url, short_code FROM links WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo "<ul>"; 
                while($row = $result->fetch_assoc()) {
                    $original_url = $row['original_url'];
                    $short_code = $row['short_code'];

                    $short_url = $_SERVER['HTTP_HOST'] . '/opencloud/opencloud/short.php?code=' . $short_code;

                    echo "<li>Originele URL: $original_url</li>";
                    echo "<li>Korte URL: <a href='$short_url' target='_blank'>$short_url</a></li>";
                }
                echo "</ul>";
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
    <a href="index.php" class="button">Terug naar home</a>
</body>
</html>
