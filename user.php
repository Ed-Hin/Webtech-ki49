<?php
    include("../../connection.php");
    
    $user_info = $_SESSION['user_info'];

    $sql = "SELECT * FROM Users where user = '$user_info'";
    $result = mysqli_query($connection,$sql);
    $info = $result->fetch_assoc
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
                <h1></h1>
                <p class="email">Email</p>
                <?php  
                echo $info['email'] ?>
                <p class="user">Username</p>
                <?php echo $info['user'] ?>
                <p class="pass">Password</p>
                <?php echo $info['pass'] ?>
            </div>
        </div>
        </div>
    </form>
</body>

</html>