<?php
include "header.php";
include("../../connection.php");

    $id = $_GET['id'];
    $username = $_GET['username'];
    $sql = "SELECT * FROM Posts WHERE postid = '$id'";
    $result = mysqli_query($connection,$sql);
    $posts = $result->fetch_assoc();
?>
    
    <link rel="stylesheet" href="user_post.css">
    <div class="posts">
            <div class="post">
                <div class="container">
                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?><p>
                <p><?php echo $posts['category'] ?></p>
                <p>By <?php echo $username ?></p>
                </div>
                <div class="extra" style="position:relative;">
                    <span class="extrainfo">10000 Likes | Published on: <?php echo $posts['datetime'] ?></span>
                </div>
            </div>
    </div>

<?php include "footer.php"; ?>