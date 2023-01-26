<!doctype html>
<html lang="eng">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="register.css">
        <title>Register | Forum</title>
    </head>
    <body>
        <form action="add_user.php" method="post">
        <div class="logo">
            <a href="home.html" title="NAME"></a>
        </div>
        
        <div class="huh">
        <div class="container">
        <span class="close"><a href="home.html">&times;</a></span>
        <h1>Register</h1>

        <label for="name"><p class="name">Name</p></label>
        <input type="text" name="name" required>

        <label for="email"><p class="email">Email</p></label>
        <input type="text" name="email" required>

        <label for="username"><p class="user">Username</p></label>
        <input type="text" name="username" required>

        <label for="password"><p class="pass">Password</p></label>
        <input type="password" name="password" required>
        
        <button type="submit">Register</button>
        </div>
        </div>
            
        </div>
    </form>
    </body>
</html>