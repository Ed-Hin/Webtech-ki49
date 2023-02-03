<?php
include "../connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = mysqli_real_escape_string($connection, htmlspecialchars($_POST["name"]));
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));
$user = mysqli_real_escape_string($connection, htmlspecialchars($_POST["username"]));
$pass = mysqli_real_escape_string($connection, htmlspecialchars($_POST["password"]));
$hash = password_hash($pass, PASSWORD_DEFAULT);

$uppercase = preg_match('@[A-Z]@', $pass);
$lowercase = preg_match('@[a-z]@', $pass);
$number = preg_match('@[0-9]@', $pass);
$specialChars = preg_match('@[^\w]@', $pass);

if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($pass) < 8) {
    $error = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character";
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
}
?>

<!doctype html>
<html lang="eng">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="register.css">
    <link rel="icon" type="image/x-icon" href="logo_alleen_symbol.png">
    <title>WhoAsked</title>
</head>

<body>
    <form action="register.php" method="post">
        <div class="logo">
            <a href="home.html" title="NAME"></a>
        </div>
        <div>
            <div class="container">
                <div style="position: relative;">
                <span class="close"><a href="index.php" class="closebtn">&times;</a></span>
                <h1>Register</h1>
<?php
if (isset($error)) {
    echo "<h4>" . $error . "</h4>"; 
}
?>
                <label for="name">
                    <p class="name">Name</p>
                </label>
                <input type="text" name="name" required>
                <label for="email">
                    <p class="email">Email</p>
                </label>
                <input type="email" name="email" required>
                <label for="username">
                    <p class="user">Username</p>
                </label>
                <input type="text" name="username" required>
                <label for="password">
                    <p class="pass">Password</p>
                </label>
                <input type="password" name="password" required>
                    <button type="submit">Register</button>
            </div>
        </div>
    </form>
</body>
</html>
