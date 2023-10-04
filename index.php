<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Cloudsite</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        .button-container {
            margin-top: 20px;
        }

        .button {
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

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<h1>Welcome, $username!</h1>";
        echo "<div class='button-container'>";
        echo "<a href='upload.php' class='button'>Upload hier je bestanden</a>";
        echo "<a href='shorten.php' class='button'>Shorten je links hier</a>";
        echo "<a href='files.php' class='button>Je bestanden</a>'";
        echo "</div>";
        echo "<p>This is your home page.</p>";
        echo "<a href='logout.php' class='button'>Logout</a>";
    } else {
        header('Location: login.php');
        exit();
    }
    ?>
</body>
</html>