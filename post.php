<?php
include("../../connection.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") { 
    $topics = mysqli_real_escape_string($connection, $_POST['topics']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $content = mysqli_real_escape_string($connection, $_POST['content']);
    $userId = $_SESSION['user_id'];
    $user = $_SESSION['login_user'];

    if ($topics == "Select topic") {
        $error = "You have forgotten to select a topic";
    }
    elseif ($topics and $title and $content and $userId) {
        $sql = "INSERT INTO `Posts` (`postid`, `user`, `datetime`, `category`, `title`, `contents`, `likes`, `dislikes`) VALUES (NULL, '$userId', CURRENT_TIMESTAMP, '$topics', '$title', '$content', '0', '0')";
        $result = mysqli_query($connection,$sql);
        header("location: index.php");
    } 
}
?>

<!doctype html>
<html lang="eng">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="post.css">
    <link rel="icon" type="image/x-icon" href="logo_only_symbol.png">
    <title>WhoAsked</title>
</head>

<body>
    <form action="post.php" method="post">
        <div>
            <div class="container">
                <div style="position: relative;">
                    <span class="close"><a href="index.php" class="closebtn">&times;</a></span>
                </div>
                <h1>Create your post</h1>
                <?php
                if (isset($error)) {
                    ?> <h4 class="error"><?php echo $error ?></h4>
                <?php }
                ?>
                <!--Filter Box-->
                <div class="filter-box">
                    <select name="topics" id="topicslist">
                        <option value="Select topic" id="Selecttopic">Select topic..</option>
                        <option value="Cars">Cars</option>
                        <option value="Pets">Pets</option>
                        <option value="Food">Food</option>
                        <option value="Memes">Memes</option>
                        <option value="Politics">Politics</option>
                        <option value="Music">Music</option>
                        <option value="Music">Sports</option>
                        <option value="Music">Gaming</option>>
                    </select>
                </div>
                <div class="post-box">
                    <label for="title">
                        <h2 class="title">Title</h2>
                    </label>
                    <textarea type="text" id="title" name="title" required></textarea>
                    <label for="content">
                        <h2 class="content">Content</h2>
                    </label>
                    <textarea type="text" id="content" name="content" required></textarea>
                    <input type="submit" value="Post">
    </form>
    </div>
    </div>

</body>

</html>