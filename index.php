<?php
include "header.php";
include("../../connection.php");
include "cookiespopup.php";
?>

<?php
    if (array_key_exists("login_user", $_SESSION)) {
    $userId = $_SESSION['user_id'];
    
    $sql = "SELECT * FROM `Posts` INNER JOIN `Users` u on Posts.user = u.ID";
    $result = mysqli_query($connection,$sql);

?>
<br>
<h1>Latest posts</h1>
<br>
    <?php 
                while($posts = $result->fetch_assoc()) { ?>
    <div class="post_info">
        <a href="posts.php">
            <div class="container">
                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?>
                <p>
                <p><?php echo $posts['category'] ?>
                <p>
                <p>By <?php echo $posts['user'] ?></p>
                <!-- USERSS?????? -->
            </div>
            <div class="extra" style="position:relative;">
                <span> Likes | Published on: <?php echo $posts['datetime'] ?></span>
            </div>
        </a>
    </div>
</div> 
    <?php
    } ?> <br> 
    <?php include "footer.php";} else { ?> 
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



