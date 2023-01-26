<?php
include '../../connection.php';

$user = mysqli_real_escape_string($connection, htmlspecialchars($_POST["user"]));
$datetime = mysqli_real_escape_string($connection, htmlspecialchars($_POST["datetime"]));
$category = mysqli_real_escape_string($connection, htmlspecialchars($_POST["category"]));
$title = mysqli_real_escape_string($connection, htmlspecialchars($_POST["title"]));
$contents = mysqli_real_escape_string($connection, htmlspecialchars($_POST["contents"]));
$likes = mysqli_real_escape_string($connection, htmlspecialchars($_POST["likes"]));
$comments = mysqli_real_escape_string($connection, htmlspecialchars($_POST["comments"]));

try {
$sql = "INSERT INTO Admins (user, datetime, category, title, contents, likes, comments) VALUES ('$user', '$datetime', '$category', '$title', '$contents', '$likes', '$comments')";
mysqli_query($connection, $sql);
} catch(PDOExeption $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>