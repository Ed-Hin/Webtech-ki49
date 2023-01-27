<?php
include "header.php";
include "footer.php";   
include("../../connection.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") { 
    $topics = mysqli_real_escape_string($connection, $_POST['topics']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $content = mysqli_real_escape_string($connection, $_POST['content']);
    $userId = $_SESSION['user_id'];
    
    $sql = "INSERT INTO `Posts` (`postid`, `user`, `datetime`, `category`, `title`, `contents`, `likes`) VALUES (NULL, '$userId', CURRENT_TIMESTAMP, '$topics', '$title', '$content', '0')";
    $result = mysqli_query($connection,$sql);
    // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    if ($result) {
        header("location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="eng">

<head>
    <link rel="stylesheet" href="post.css">
</head>

<body>
    <h1>Create your post</h1>
    <form action="post.php" method="post">
        <?php
            if (isset($error)) {
                echo "<h4> Error: " . $error . "</h4>";
            }
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
            </select>
        </div>
        <div class="post-box">
            <label for="title">Title</label><br><br>
            <textarea type="text" id="title" name="title" placeholder="Title.."></textarea><br><br>
            <label for="content">Content</label> <br><br>
            <textarea type="text" id="content" name="content" placeholder="Content.."></textarea><br>
            <input type="submit" value="Post">
    </form>

    </div>

</body>

</html>