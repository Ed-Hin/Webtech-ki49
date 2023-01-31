<?php
include "header.php";
include "../../connection.php";
?>

<?php
if (array_key_exists("login_user", $_SESSION)) {
    $userId = $_SESSION['user_id'];

    $sql = "SELECT * FROM `Posts` JOIN `Users` u on Posts.user = u.ID";
    $result = mysqli_query($connection, $sql);

    ?>

<body>
    <br>
    <h1>Latest posts</h1>
    <div class="posts">

        <?php
while ($posts = $result->fetch_assoc()) {?>
        <div class="post_info">
            <div class="container">
                <a href="user_post.php?id=<?php echo $posts['postid']; ?>&username=<?php echo $posts['user']; ?>">
                    <h2><?php echo $posts['title'] ?></h2>
                    <p><?php echo $posts['contents'] ?></p>
                    <p><?php echo $posts['category'] ?></p>
                    <p>By <?php echo $posts['user'] ?></p>
                    <!-- USERSS?????? -->
                    <div class="extra" style="position:relative;">
                        <span> <?php echo $posts['likes'] ?> Likes | Published on:
                            <?php echo $posts['datetime'] ?></span>
                    </div>
                </a>
            </div>
        </div>
</body>
<?php
}?> 
</div>
<?php } else { ?>
<div class="mainpage">
    <div class="txt">
        <h1 class="welcome">Welcome to<br>WhoAsked!</h1>
        <h2 class="sign">Sign up now!</h2>
    </div>
    <div class="HomeImage">
        <img src="interaction.png" alt="interaction" class="interaction" width="550" height="550">
    </div>
</div>
<?php } ?>

<?php
include "footer.php";
include "cookiespopup.php";
?>