<?php
include '../../connection.php';

$category = mysqli_real_escape_string($connection, htmlspecialchars($_POST["category"]));
$title = mysqli_real_escape_string($connection, htmlspecialchars($_POST["title"]));
$contents = mysqli_real_escape_string($connection, htmlspecialchars($_POST["contents"]));

try {
$sql = "INSERT INTO Posts (category, title, contents) VALUES ('$category', '$title', '$contents')";
mysqli_query($connection, $sql);
} catch(PDOExeption $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>