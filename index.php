<?php
include "header.php";
include("../../connection.php");
include "cookiespopup.php";
?>

<?php
    if (array_key_exists("login_user", $_SESSION)) {
    $userId = $_SESSION['user_id'];
    $user = $_SESSION['login_user'];
    
    $sql1 = "SELECT * FROM Posts WHERE user = '$userId'";
    $sql2 = "SELECT * FROM Users where user = '$user'";
    $result1 = mysqli_query($connection,$sql1);
    $result2 = mysqli_query($connection,$sql2);
        
        $info = $result2->fetch_assoc();
?>

<h1>Latest posts</h1>

    <?php 
            while($posts = $result1->fetch_assoc()) { ?>
    <div class="post_info">
        <a href="posts.php">
            <div class="container">
                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?>
                <p>
                <p><?php echo $posts['category'] ?>
                <p>
                <p>By <?php echo $info['user'] ?></p>
                <!-- USERSS?????? -->
            </div>
            <div class="extra" style="position:relative;">
                <span> Likes | Published on: <?php echo $posts['datetime'] ?></span>
            </div>
        </a>
    </div>
</div>    
    <?php
    } include "footer.php";} else { ?>
    <div class="mainpage">
        <div class="txt">
            <h1 class="welcome">Welcome to<br>WhoAsked!</h1>
            <h2 class="sign">Sign up now!</h2>
        </div>
        <div class="HomeImage">
        <img src="interaction.png" alt="interaction" class="interaction" width="550" height="550">
    </div>
    </div>
    
    <?php 
    include "indexfooter.php"; } ?>



