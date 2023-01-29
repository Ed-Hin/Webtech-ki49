<?php
include "header.php";
include("../../connection.php");

$userId = $_SESSION['user_id'];

$sql = "SELECT * FROM Posts WHERE user = '$userId'";
$result = mysqli_query($connection,$sql);

?> 

<div class="posts">
    <h1>Latest posts</h1>
    <?php
        if (array_key_exists("login_user", $_SESSION)) {
            // ERROR ALS NIET INGELOGD???
            while($posts = $result->fetch_assoc()) { ?> 
        <div class="post_info">
            <a href="posts.php">
            <div class="container">    
            <h2><?php echo $posts['title'] ?></h2>
            <p><?php echo $posts['contents'] ?><p>
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
