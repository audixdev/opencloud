<?php
include 'db.php';


$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];


$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Registratie succesvol!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
