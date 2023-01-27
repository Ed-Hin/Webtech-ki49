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
    <form action="add_user.php" method="post">
        <div class="logo">
            <a href="home.html" title="NAME"></a>
        </div>

        <div class="huh">
            <div class="container">
                <div style="position: relative;">
                <span class="close"><a href="index.php" class="closebtn">&times;</a></span>
                <h1>Register</h1>

                <label for="name">
                    <p class="name">Name</p>
                </label>
                <input type="text" name="name" required>

                <label for="email">
                    <p class="email">Email</p>
                </label>
                <input type="text" name="email" required>

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

        </div>
    </form>
</body>

</html>