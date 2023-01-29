<?php
include '../../connection.php';

$name = mysqli_real_escape_string($connection, htmlspecialchars($_POST["name"]));
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));
$user = mysqli_real_escape_string($connection, htmlspecialchars($_POST["username"]));
$pass = mysqli_real_escape_string($connection, htmlspecialchars($_POST["password"]));
$hash = password_hash($pass, PASSWORD_DEFAULT);


try {
$sql = "INSERT INTO Users (name, user, email, pass) VALUES ('$name', '$user', '$email', '$hash')";
mysqli_query($connection, $sql);
} catch(PDOExeption $e) {
    echo $sql . "<br>" . $e->getMessage();
}
// redirect naar homepage of ingelogde page idk
?>