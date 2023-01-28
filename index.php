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
    <?php while($posts = $result->fetch_assoc()) { ?> 
        <div class="post">
            <div class="container">    
            <h2><?php echo $posts['title'] ?></h2>
            <p><?php echo $posts['contents'] ?><p>
            <h3>10000 Likes | Published on: <?php echo $posts['datetime'] ?></h3>
            </div>
        </div>
    <?php } ?> 
    </a>
    <br>
    <!-- <a href="posts.php">
        <div class="post2">
            <div class="container2">
                <h2>Ik vind dit echt vet</h2>
                <p>jatoch</p>
                <h3>10000 Likes | Published on: ../../....</h3>
            </div>
        </div>
    </a> -->
    <div class="HomeImage">
        <img src="interaction.png" alt="interaction" width="400" height="400">
    </div>
</div>