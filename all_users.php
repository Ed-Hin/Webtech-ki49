<?php
    include("../../connection.php");
    session_start();

    $user_info = $_SESSION['login_user'];

    $sql = "SELECT * FROM Users";
    $result = mysqli_query($connection,$sql);

?>    

<!doctype html>
<html lang="eng">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="all_users.css">
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
                <h1>All Users</h1>
                <?php while($user = $result->fetch_assoc()) { ?>
                    <p style="text-align:center"><?php echo $user['name'] ?></p>
                    <?php } ?>
            </div>
        </div>
        </div>
    </form>
</body>
</html>