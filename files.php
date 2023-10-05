<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opencloud - Mijn Bestanden</title>
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
    <h1>Mijn Bestanden</h1>

    <?php
    session_start();

    include 'db.php';


    if(isset($_SESSION['username'])){
        $user_id = $_SESSION['user_id']; 

        $sql = "SELECT * FROM files WHERE user_id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $filename = $row['filename'];
                $file_path = 'uploads/' . $filename;

                $file_link = 'http://' . $_SERVER['HTTP_HOST'] . '/opencloud/opencloud/' . $file_path; 

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
    <a href="index.php" class="button">Terug naar home</a>
</body>
</html>
