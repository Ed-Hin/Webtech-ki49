<?php
include "../../connection.php";
session_start();

if (array_key_exists("login_user", $_SESSION)) {
    // Gegevens die worden gepakt voor degene die is ingelogd.
    $user_id = mysqli_real_escape_string($connection, $_SESSION['login_user']);
    $my_user_id = "SELECT * FROM Users WHERE user = '$user_id'";
    $admin = mysqli_query($connection, $my_user_id);
    $admin_check = mysqli_fetch_array($admin, MYSQLI_ASSOC);

    $sql = "SELECT * FROM Users";
    $result = mysqli_query($connection, $sql);
}
?>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="all_users.css">
    <link rel="icon" type="image/x-icon" href="logo_only_symbol.png">
    <title>WhoAsked</title>
</head>
<body>
    <?php
if (array_key_exists("login_user", $_SESSION) and $admin_check['isadmin'] == 1) {
    // Scherm voor degene die is ingelogd en een admin is.
    ?>
    <form action="login.php" method="post">
            <div class="container">
                <div style="position: relative;">
                    <span class="close"><a href="index.php" class="closebtn">&times;</a></span>
                </div>
                <h1>All Users</h1>
                <?php while ($user = $result->fetch_assoc()) {?>
                    <p><?php echo $user['name'] ?></p>
                    <?php }?>
            </div>
    </form>
</body>
<?php 
} else {
    // Scherm voor degene die iets anders is dan een ingelogde admin.
?>
    <div class="container">
    <h1>NO PERMISSION</h1>
    </div>
<?php 
}
?>
</html>