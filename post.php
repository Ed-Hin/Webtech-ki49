<?php
include("../../connection.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") { 
    $topics = mysqli_real_escape_string($connection, $_POST['topics']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $content = mysqli_real_escape_string($connection, $_POST['content']);
    $userId = $_SESSION['user_id'];
    $user = $_SESSION['login_user'];

    $sql = "INSERT INTO `Posts` (`postid`, `user`, `datetime`, `category`, `title`, `contents`, `likes`) VALUES (NULL, '$userId', CURRENT_TIMESTAMP, '$topics', '$title', '$content', '0')";
    $result = mysqli_query($connection,$sql);
    // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    if ($result) {
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
        <?php
            if (isset($error)) {
                echo "<h4> Error: " . $error . "</h4>";
            }
        ?>
        <div>
            <div class="container">
                <div style="position: relative;">
                    <span class="close"><a href="index.php" class="closebtn">&times;</a></span>
                </div>
                <h1>Create your post</h1>

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
                    </select>
                </div>
                <div class="post-box">
                    <label for="title">
                        <p class="title">Title</p>
                    </label>
                    <textarea type="text" id="title" name="title"></textarea>
                    <label for="content">
                        <p class="content">Content</p>
                    </label>
                    <textarea type="text" id="content" name="content"></textarea>
                    <input type="submit" value="Post">
    </form>
    </div>
    </div>

</body>

</html>