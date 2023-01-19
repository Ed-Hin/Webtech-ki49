<?php
include '../../connection.php';

$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));
$user = mysqli_real_escape_string($connection, htmlspecialchars($_POST["user"]));
$pass = mysqli_real_escape_string($connection, htmlspecialchars($_POST["pass"]));

try {
$sql = "INSERT INTO Users (user, email, pass) VALUES ('$user', '$email', '$pass')";
mysqli_query($connection, $sql);
} catch(PDOExeption $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>