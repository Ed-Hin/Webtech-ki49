<?php
include "../connection.php";
session_start();

$name = mysqli_real_escape_string($connection, htmlspecialchars($_POST["name"]));
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));
$user = mysqli_real_escape_string($connection, htmlspecialchars($_POST["username"]));
$pass = mysqli_real_escape_string($connection, htmlspecialchars($_POST["password"]));
$hash = password_hash($pass, PASSWORD_DEFAULT);

$uppercase = preg_match('@[A-Z]@', $pass);
$lowercase = preg_match('@[a-z]@', $pass);
$number    = preg_match('@[0-9]@', $pass);
$specialChars = preg_match('@[^\w]@', $pass);

if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
    echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character';
} else {
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
}