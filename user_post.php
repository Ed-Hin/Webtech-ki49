<?php
include "header.php";
include "../../connection.php";

// id en username in deze file bereikbaar maken
$id = $_GET['id'];
$id = mysqli_real_escape_string($connection, $id);

// informatie voor de post waarbij de id hetzelfde is, zodat het dezelfde post is.
$sql = "SELECT * FROM Posts JOIN `Users` u on Posts.user = u.ID WHERE postid = '$id'";
$result = mysqli_query($connection, $sql);
$posts = $result->fetch_assoc();

// Kijken wie het is, admin, user of bezoeker
if (array_key_exists("login_user", $_SESSION)) {
    $user_id = mysqli_real_escape_string($connection, $_SESSION['login_user']);
    $my_user_id = "SELECT * FROM Users WHERE user = '$user_id'";
    $admin = mysqli_query($connection, $my_user_id);
    $admin_check = mysqli_fetch_array($admin, MYSQLI_ASSOC);

    // if statement voor de admin om posts te verwijderen
if (isset($_POST['submit_delete'])) {
    $delete = "DELETE FROM Posts WHERE postid = '$id'";
    mysqli_query($connection, $delete);
}

// Comments in de database inserten
if (isset($_POST['submit_comment'])) {
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    $comment_user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);
    $comment = "INSERT INTO Comments (`id`, `message`, `postid`, `userid`) VALUES (NULL, '$message', '$id', '$comment_user_id')";
    $results = mysqli_query($connection, $comment);
    }
}
?>

<link rel="stylesheet" href="user_post.css">
<?php
if (array_key_exists("login_user", $_SESSION) and $admin_check['isadmin'] == 1) {
    ?>
<div class="user_post_container">
    <div class="user_post_main">
        <div class="posts">
            <div class="post">
                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?></p>
                <p><?php echo $posts['category'] ?></p>
                <p>By <?php echo $posts['user'] ?></p>
                <div class="extra" style="position:relative;">
                    <span class="extrainfo">
                        <?php echo $posts['likes'] ?> Likes | Published on: <?php echo $posts['datetime'] ?>
                    </span>
                    <form action="" method="post">
                        <input class="delete_button" type="submit" name="submit_delete" value="Delete">
                    </form>
                </div>
            </div>
        </div>
        <div class="comment_content">
            <div class="wrapper">
                <form action="" method="post" class="form">
                    <textarea name="message" value="message" cols="30" rows="1" class="comment_message"
                        placeholder="Comment..."></textarea>
                    <button type="submit" value="Post" class="comment_btn" name="submit_comment">Submit Comment</button>
                </form>
            </div>
        </div>
        <?php
    $comments = "SELECT * FROM `Comments` c JOIN Users u WHERE postid = '$id' AND u.ID = c.userid";
    $results = $connection->query($comments);

    if ($results->num_rows > 0) {
        // output data of each row
        while ($row = $results->fetch_assoc()) {?>
        <div class="comment_container">
            <p><?php echo $row['message']; ?></p>
            <p>By <?php echo $row['user']; ?></p>
        </div>
        <?php
        }
    }
    ?>
    </div>
</div>
<?php
} elseif (array_key_exists("login_user", $_SESSION)) {
?>
<div class="user_post_container">
    <div class="user_post_main">
        <div class="posts">
            <div class="post">
                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?>
                <p>
                <p><?php echo $posts['category'] ?></p>
                <p>By <?php echo $posts['user'] ?></p>
            </div>
            <div class="extra" style="position:relative;">
                <span class="extrainfo">
                    <?php echo $posts['likes'] ?> Likes | Published on: <?php echo $posts['datetime'] ?>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="comment_content">
    <div class="wrapper">
        <form action="" method="post" class="form">
            <textarea name="message" value="message" cols="30" rows="1" class="comment_message" placeholder="Comment..."></textarea>
            <button type="submit" value="Post" class="comment_btn" name="submit_comment">Submit Comment</button>
        </form>
    </div>
</div>

<?php
    $comments = "SELECT * FROM Comments c JOIN Users u WHERE postid = $id AND u.ID = c.userid";
    $results = $connection->query($comments);

    if ($results->num_rows > 0) {
        // output data of each row
        while ($row = $results->fetch_assoc()) {?>
<div class="comment_container">
    <p><?php echo $row['message']; ?></p>
    <p>By <?php echo $row['user']; ?></p>
</div>
<?php
}
    }
    ?>
</div>
</div>
<?php
} else {
    ?>
<body>
    <div class="index_container">
        <div class="welcome_main">
            <div class="txt">
                <h1 class="welcome">Welcome to<br>WhoAsked!</h1>
                <h2 class="sign">Sign up now!</h2>
            </div>
            <div class="HomeImage">
                <img src="interaction.png" alt="interaction" class="interaction" width="550" height="550">
            </div>
        </div>
    </div>
</body>
<?php
}
?>
<?php include "footer.php";?>