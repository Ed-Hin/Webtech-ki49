<?php
include "../../connection.php";
session_start();

// Als er op de knop post wordt gedrukt, dan
// worden alle gegevens ingevuld in de database,
// maar als niet alles is ingevuld, geeft hij
// errors aan en wordt er gezegd wat misging.
if($_SERVER["REQUEST_METHOD"] == "POST") { 
    // $userId = $_SESSION['user_id'];
    $user = $_SESSION['login_user'];
    $user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);
    $topics = mysqli_real_escape_string($connection, $_POST['topics']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $content = mysqli_real_escape_string($connection, $_POST['content']);

    if ($topics == "Select topic") {
        $error = "You have forgotten to select a topic";
    }
    elseif ($topics and $title and $content and $user_id) {
        $sql = "INSERT INTO `Posts` (`postid`, `user`, `datetime`, `category`, `title`, `contents`, `likes`, `dislikes`) VALUES (NULL, '$user_id', CURRENT_TIMESTAMP, '$topics', '$title', '$content', '0', '0')";
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
<?php
if (array_key_exists("login_user", $_SESSION)) {
    // Scherm voor degene die is ingelogd.
?>

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
                        <option value="Sports">Sports</option>
                        <option value="Gaming">Gaming</option>
                        <option value="Topical">Topical</option>
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
<?php
} else {
    // Scherm voor degene die nog niet is ingelogd.
?>
<div class="container">
    <h1>NO PERMISSION</h1>
</div>
<?php 
} 
?>

</html>