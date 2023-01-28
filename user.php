<?php
    include("../../connection.php");

    $user = $_SESSION['user_id'];

    $sql = "SELECT * FROM Users WHERE user = '$user'";
    $result = mysqli_query($connection,$sql);
    $user = $result->fetch_assoc
?>    

<!doctype html>
<html lang="eng">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="s    tylesheet" href="user.css">
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
                <h1></h1>
                <p class="email">Email</p>
                <?php  
                echo $user["username"] ?>
                <p class="user">Username</p>
                <?php echo $user["password"] ?>
                <p class="pass">Password</p>
                <?php echo $user["password"] ?>
            </div>
        </div>
        </div>
    </form>
</body>

</html>