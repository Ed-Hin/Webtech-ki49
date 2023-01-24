<?php
session_start();
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="home.css">
    <title>WhoAsked</title>
    <link rel="icon" type="image/x-icon" href="logo_alleen_symbol.png">
</head>
    <body>
        <header>
            <img src="https://cdn.discordapp.com/attachments/760819935751438376/1065750623917711540/logo_white.png" class="logo" alt="WhoAsked">
                <ul class="navbar">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="popular.php">Popular</a></li>
                    <li><a href="topics.php">Topics</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            <div class="personal">
                <a href="login.php" class="user">Login</a>
                <a href="register.php">Register</a>
            </div>
        </header>
    </body>
</html>
