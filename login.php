<?php
include "../../connection.php";
session_start();

// Als er op de login knop wordt gedrukt.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Alle gegevens bij het inloggen.
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $mypassword = mysqli_real_escape_string($connection, $_POST['password']);

    $sql = "SELECT * FROM Users WHERE user = '$username'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // Checkt of de username en password bij elkaar horen.
    if ($row) {
        if (password_verify($mypassword, $row["pass"])) {
            $_SESSION['login_user'] = $username;
            $_SESSION['user_id'] = $row["ID"];
            header("location: index.php");
        } else {
            // Zo niet deze errors.
            $error = "Your Login Name or Password is invalid";
        }
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>

<!doctype html>
<html lang="eng">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="login.css">
    <link rel="icon" type="image/x-icon" href="logo_only_symbol.png">
    <title>WhoAsked</title>
</head>
<body>
    <form action="login.php" method="post">
        <div>
            <div class="container">
                <div style="position: relative;">
                    <span class="close"><a href="index.php" class="closebtn">&times;</a></span>
                </div>
                <h1>Log In</h1>
<?php
// Hier wordt de error onder Log In ingevuld 
if (isset($error)) {
    echo "<h4>" . $error . "</h4>";
}
?>
                <label for="username">
                    <p class="user">Username</p>
                </label>
                <input type="text" name="username" required>
                <label for="password">
                    <p class="pass">Password</p>
                </label>
                <input type="password" name="password" required>
                <button type="submit">Log In</button>
            </div>
        </div>
        </div>
    </form>
</body>
</html>