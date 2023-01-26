<?php
include '../../connection.php';

$comment = mysqli_real_escape_string($connection, htmlspecialchars($_POST["comment"]));

try {
$sql = "INSERT INTO Comments (comment) VALUES ('$comment')";
mysqli_query($connection, $sql);
} catch(PDOExeption $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>