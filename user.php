<?php
    include("../../connection.php");
    session_start();

    $user_info = $_SESSION['login_user'];

    $sql = "SELECT * FROM Users where user = '$user_info'";
    $result = mysqli_query($connection,$sql);
    $info = $result->fetch_assoc()

?>    

<!doctype html>
<html lang="eng">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="user.css">
    <link rel="icon" type="image/x-icon" href="logo_only_symbol.png">
    <title>WhoAsked</title>
</head>

<body>
    <form action="login.php" method="post">
        <div class="huh">
            <div class="container">
                <div style="position: relative;">
                    <span class="close"><a href="index.php" class="closebtn">&times;</a></span>
                </div>
                <h1>Profile</h1>
                <h3 class="name">Name</h3>
                <p><?php echo $info['name'] ?></p>
                <h3 class="email">Email</h3>
                <p><?php echo $info['email'] ?></p>
                <h3 class="user">Username</h3>
                <p><?php echo $info['user'] ?></p>
            </div>
        </div>
        </div>
    </form>
</body>

</html>