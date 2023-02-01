<?php
include "../../connection.php";
session_start();

$name = mysqli_real_escape_string($connection, htmlspecialchars($_POST["name"]));
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));
$user = mysqli_real_escape_string($connection, htmlspecialchars($_POST["username"]));
$pass = mysqli_real_escape_string($connection, htmlspecialchars($_POST["password"]));
$hash = password_hash($pass, PASSWORD_DEFAULT);

try {
    $sql = "INSERT INTO Users (name, user, email, pass) VALUES ('$name', '$user', '$email', '$hash')";
    mysqli_query($connection, $sql);

    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $mypassword = mysqli_real_escape_string($connection, $_POST['password']);
    $login = "SELECT * FROM Users WHERE user = '$username'";
    $result = mysqli_query($connection, $login);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row) {
        if (password_verify($mypassword, $row["pass"])) {
            $_SESSION['login_user'] = $username;
            $_SESSION['user_id'] = $row["ID"];
            header("location: index.php");
        }
    }

} catch (PDOExeption $e) {
    echo $sql . "<br>" . $e->getMessage();
}