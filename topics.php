<?php
include "header.php";
include("../../connection.php");
    
    if (array_key_exists("login_user", $_SESSION)) {
        $userId = $_SESSION['user_id'];
    }
    
    $sql = "SELECT * FROM `Posts` JOIN `Users` u on Posts.user = u.ID";
    $result = mysqli_query($connection,$sql);

    if($_SERVER["REQUEST_METHOD"] == "POST") { 
        if(isset($_POST['topics']) && $_POST['topics'] !=='Select') {
            $category = $_POST['topics'];
            $sql = "SELECT * FROM Posts where category = '$category'";
            $result = mysqli_query($connection, $sql);
        }
    }
?>

<link rel="stylesheet" href="topics.css">
<br><br><br><br><br>

<body>
    <form action="topics.php" method="post">
        <div class="filter-box">
            <select name="topics" id="topicslist">
                <option value="Select" id="Selecttopic">Select topic..</option>
                <option value="Cars">Cars</option>
                <option value="Pets">Pets</option>
                <option value="Food">Food</option>
                <option value="Memes">Memes</option>
                <option value="Politics">Politics</option>
                <option value="Music">Music</option>
                <option value="Sports">Sports</option>
                <option value="Gaming">Gaming</option>
            </select>
        </div>
        <input type="submit" name="submit" value="submit">
    </form>

<?php
    while($posts = $result->fetch_assoc()) { ?>
    <div class="post_info">
        <a href="posts.php">
            <div class="container">

                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?></p>
                <p><?php echo $posts['category'] ?></p>
                <p>By <?php echo $posts['user'] ?></p>
                <div class="extra" style="position:relative;">
                    <span> Likes | Published on: <?php echo $posts['datetime'] ?></span>
                </div>
            </div>
        </a>
    </div>
    <?php } ?>
</body>

<?php
include "footer.php";
?>