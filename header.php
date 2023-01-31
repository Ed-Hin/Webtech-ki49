<?php
    include("../../connection.php");
    session_start();

    if (array_key_exists("login_user", $_SESSION)) {
        $username = $_SESSION['login_user'];
        $sql = "SELECT * FROM Users WHERE user = '$username'";
        $result = mysqli_query($connection,$sql);
        $user_info = mysqli_fetch_array($result,MYSQLI_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="index.css">
    <title>WhoAsked</title>
    <link rel="icon" type="image/x-icon" href="logo_only_symbol.png">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

<body>
    <header>
        <img src="logo_white.png" class="logo" alt="WhoAsked">
        <ul class="navbar">
            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="popular.php" class="nav-link">Popular</a></li>
            <li class="nav-item"><a href="topics.php" class="nav-link">Topics</a></li>
            <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
        </ul>
        <div class="personal">
            <?php
                if (array_key_exists("login_user", $_SESSION) and $user_info['isadmin'] == 1) {
                    ?>
            <a href="all_users.php">All Users</a>
            <a href="user.php"><?php echo $_SESSION ["login_user"]; ?></a>
            <a href="logout.php" class="user">Logout</a>
            <a href="post.php"><button>POST</button></a>
            
            <?php
                } elseif (array_key_exists("login_user", $_SESSION)) { 
                ?>
                <a href="user.php"><?php echo $_SESSION ["login_user"]; ?></a>
                <a href="logout.php" class="user">Logout</a>
                <a href="post.php"><button>POST</button></a>

            <?php
                    } else {
                ?>
                <a href="login.php" class="user">Login</a>
                <a href="register.php">Register</a>
                <?php
                    }
                ?>
        </div>
    </header>
    <script>
    $(document).ready(function() {

        $('ul.navbar > li').each(function(x) {
            console.log(x, window.location.href.includes($(this).text().toLowerCase()))
            if (    
                window.location.href.replace("index", "home").includes($(this).text().toLowerCase())) {
                $(this).addClass('active');
            }
        })
    })
    </script>
</body>
</html>