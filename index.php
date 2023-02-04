<?php
include "header.php";
include "../connection.php";

if (array_key_exists("login_user", $_SESSION)) {
    $user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);
    $sql = "SELECT * FROM `Posts` JOIN `Users` u on Posts.user = u.ID";
    $result = mysqli_query($connection, $sql);
    ?>

<body>
    <div class="index_container">
        <div class="index_main">
            <br>
            <h1>Latest posts</h1>
            <div class="posts">
                <?php
while ($posts = $result->fetch_assoc()) {
        ?>
                <div class="post_info">
                    <div class="post_container">
                        <a
                            href="user_post.php?id=<?php echo $posts['postid']; ?>">
                            <h2><?php echo $posts['title'] ?></h2>
                            <p><?php echo $posts['contents'] ?></p>
                            <p><?php echo $posts['category'] ?></p>
                            <p>By <?php echo $posts['user'] ?></p>
                            <div class="extra" style="position:relative;">
                                <span class="date"> <?php echo $posts['likes'] ?> Likes | Published on:
                                    <?php echo $posts['datetime'] ?></span>
                            </div>
                        </a>
                    </div>
                </div>
</body>
<?php
}
    ?>
</div>
</div>
</div>
<?php
} else {
    ?>
<div class="index_container">
    <div class="welcome_main">
        <div class="txt">
            <h1 class="welcome">Welcome to<br>WhoAsked!</h1>
            <h2 class="sign">Sign up now!</h2>
        </div>
        <div class="HomeImage">
            <img src="interaction.png" alt="interaction" class="interaction" width="550" height="550">
        </div>
    </div>
</div>

<?php
}
include "footer.php";
include "cookiespopup.php";
?>