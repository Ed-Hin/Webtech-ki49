<?php
include "header.php";
include "footer.php";
include("../../connection.php");

$userId = $_SESSION['user_id'];

$sql = "SELECT * FROM Posts WHERE user = '$userId'";
$result = mysqli_query($connection,$sql);

?> 

<div class="posts">
    <h1>Latest posts</h1>
    <br>
    <a href="posts.php">
    <?php
        if (array_key_exists("login_user", $_SESSION)) {
            // ERROR ALS NIET INGELOGD???
            while($posts = $result->fetch_assoc()) { ?> 
        <div class="post_info">
            <div class="container">    
            <h2><?php echo $posts['title'] ?></h2>
            <p><?php echo $posts['contents'] ?><p>
            <!-- USERSS?????? -->
            </div>
            <div class="extra" style="position:relative;">
            <span> Likes | Published on: <?php echo $posts['datetime'] ?></span>
            </div>
        </div>
    <?php }} ?> 
    </a>
    <div class="HomeImage">
        <img src="interaction.png" alt="interaction" width="400" height="400">
    </div>
</div>