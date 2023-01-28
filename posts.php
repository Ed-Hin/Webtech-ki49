<?php
include "header.php";
include "footer.php";
include("../../connection.php");

$userId = $_SESSION['user_id'];

$sql = "SELECT * FROM Posts WHERE user = '$userId'";
$result = mysqli_query($connection,$sql);
$posts = $result->fetch_assoc();
?>

<link rel="stylesheet" href="posts.css">

<div class="posts">
    <?php { ?> 
        <div class="post">
            <div class="container">    
            <h2><?php echo $posts['title'] ?></h2>
            <p><?php echo $posts['contents'] ?><p>
            <div class="extra" style="position:relative;">
                <span>10000 Likes | Published on: <?php echo $posts['datetime'] ?></span>
            </div>
        </div>
        </div>
    <?php } ?> 
</div>