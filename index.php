<?php
include "header.php";
include("../../connection.php");
include "cookiespopup.php";

$userId = $_SESSION['user_id'];
$user = $_SESSION['login_user'];

$sql1 = "SELECT * FROM Posts WHERE user = '$userId'";
$sql2 = "SELECT * FROM Users where user = '$user'";
$result1 = mysqli_query($connection,$sql1);
$result2 = mysqli_query($connection,$sql2);

$info = $result2->fetch_assoc();

?> 

<div class="posts">
    <h1>Latest posts</h1>
    <?php
        if (array_key_exists("login_user", $_SESSION)) {
            // ERROR ALS NIET INGELOGD???
            while($posts = $result1->fetch_assoc()) { ?> 
        <div class="post_info">
            <a href="posts.php">
            <div class="container">  
            <h2><?php echo $posts['title'] ?></h2>
            <p><?php echo $posts['contents'] ?><p>
            <p><?php echo $posts['category'] ?><p>
            <p>By <?php echo $info['user'] ?></p>
            <!-- USERSS?????? -->
            </div>
            <div class="extra" style="position:relative;">
            <span> Likes | Published on: <?php echo $posts['datetime'] ?></span>
            </div>
            </a>
        </div>
    <?php }} ?> 
    <div class="HomeImage">
        <img src="interaction.png" alt="interaction" class="interaction" width="400" height="400">
    </div>
</div>

<?php
include "indexfooter.php";
?>
