<?php
include '../../connection.php';

$name = mysqli_real_escape_string($connection, htmlspecialchars($_POST["name"]));
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));
$user = mysqli_real_escape_string($connection, htmlspecialchars($_POST["username"]));
$pass = mysqli_real_escape_string($connection, htmlspecialchars($_POST["password"]));

try {
$sql = "INSERT INTO Users (name, user, email, pass) VALUES ('$name', '$user', '$email', '$pass')";
mysqli_query($connection, $sql);
} catch(PDOExeption $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>