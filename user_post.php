<?php
include "header.php";
include "../../connection.php";

// id en username in deze file bereikbaar maken.
$id = $_GET['id'];
$id = mysqli_real_escape_string($connection, $id);
$like_user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);

// Kijken wie het is, admin, user of bezoeker.
if (array_key_exists("login_user", $_SESSION)) {

    $user_id = mysqli_real_escape_string($connection, $_SESSION['login_user']);
    $my_user_id = "SELECT * FROM Users WHERE user = '$user_id'";
    $admin = mysqli_query($connection, $my_user_id);
    $admin_check = mysqli_fetch_array($admin, MYSQLI_ASSOC);

    // Als er op de delete knop wordt gedrukt, wordt de bijbehorende post verwijderd.
    if (isset($_POST['submit_delete'])) {
        $id = mysqli_real_escape_string($connection, $_GET['id']);
        $delete = "DELETE FROM Posts WHERE postid = '$id'";
        mysqli_query($connection, $delete);
        header("location:index.php");
    }

    // Comments in de database inserten.
    if (isset($_POST['submit_comment'])) {
        $id = mysqli_real_escape_string($connection, $_GET['id']);
        $message = mysqli_real_escape_string($connection, $_POST['message']);
        $comment_user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);
        $comment = "INSERT INTO Comments (`id`, `message`, `postid`, `userid`) VALUES (NULL, '$message', '$id', '$comment_user_id')";
        $comment_results = mysqli_query($connection, $comment);
    }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="user_post.css">

<?php
if (array_key_exists("login_user", $_SESSION) and $admin_check['isadmin'] == 1) {
    // Scherm voor degene die ingelogd is en een admin is.
    // informatie voor de post waarbij de id hetzelfde is, zodat het dezelfde post is.
    $sql = "SELECT * FROM Posts JOIN `Users` u on Posts.user = u.ID WHERE postid = '$id'";
    $result = mysqli_query($connection, $sql);
    $posts = mysqli_fetch_array($result);

    ?>
<div class="user_post_container">
    <div class="user_post_main">
        <div class="user_posts">
            <div class="post" id="post_container" data-id="<?php echo $posts['postid']; ?>">
                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?></p>
                <p><?php echo $posts['category'] ?></p>
                <p>By <?php echo $posts['user'] ?></p>
                <p>Published on: <?php echo $posts['datetime'] ?></p>
                <form action="" method="post">
                    <button name="like_button" style="color:blue" id="likescount"
                        class="likes_count"><?php echo $posts['likes']; ?> Likes</button>
                    <button name="dislike_button" style="color:blue" id="dislikescount"
                        class="dislikes_count"><?php echo $posts['dislikes']; ?> Dislikes</button>
                </form>
                <br>
                <?php
if (isset($_POST['like_button'])) {
    // Als er op de likes knop wordt gedrukt, kan er geliked worden.
        $check_sql = "SELECT * FROM Likes WHERE userid = '$like_user_id' AND postid=" . $posts['postid'] . "";
        $like_results = mysqli_query($connection, $check_sql);
        if (mysqli_num_rows($like_results) == 1) {
            ?>
                <!-- De user heeft de post al geliked -->
                <span id="unlike" class="unlike fa fa-thumbs-up" name="like_button"
                    data-id="<?php echo $posts['postid']; ?>"></span>
                <span id="like" class="like hide fa fa-thumbs-o-up" data-id="<?php echo $posts['postid']; ?>"></span>
                <?php } else {?>
                <!-- De user heeft de post nog niet geliked -->
                <span id="like" class="like fa fa-thumbs-o-up" data-id="<?php echo $posts['postid']; ?>"></span>
                <span id="unlike" class="unlike hide fa fa-thumbs-up" name="like_button"
                    data-id="<?php echo $posts['postid']; ?>"></span>
                <?php }
    }

    if (isset($_POST['dislike_button'])) {
        // Als er op de dislikes knop wordt gedrukt, kan er gedisliked worden.
        $dislike_results = mysqli_query($connection, "SELECT * FROM Dislikes WHERE userid = '$like_user_id' AND postid=" . $posts['postid'] . "");
        if (mysqli_num_rows($dislike_results) == 1) {
            ?>
                <!-- De user heeft de post al gedisliked -->
                <span class="undislike fa fa-thumbs-down" data-id="<?php echo $posts['postid']; ?>"></span>
                <span class="dislike hide fa fa-thumbs-o-down" data-id="<?php echo $posts['postid']; ?>"></span>
                <?php } else {?>
                <!-- De user heeft de post nog niet gedisliked -->
                <span class="dislike fa fa-thumbs-o-down" data-id="<?php echo $posts['postid']; ?>"></span>
                <span class="undislike hide fa fa-thumbs-down" data-id="<?php echo $posts['postid']; ?>"></span>
                <?php }
    }?>
                <div class="extra" style="position:relative;">
                <!-- Knop voor de admin om de post te verwijderen -->
                    <form action="" method="post">
                        <input class="delete_button" type="submit" name="submit_delete" value="Delete">
                    </form>
                </div>
            </div>
            <!-- De plek voor de comments -->
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
            // Hier worden de comments gelijk ingevuld als ze zijn gemaakt.
    $comments = "SELECT * FROM `Comments` c JOIN Users u WHERE postid = '$id' AND u.ID = c.userid";
    $comment_results = $connection->query($comments);

    if ($comment_results->num_rows > 0) {
        // output data of each row
        while ($row = $comment_results->fetch_assoc()) {?>
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
</div>

<?php
} elseif (array_key_exists("login_user", $_SESSION)) {
    // Scherm voor degene die zijn ingelogd
    // id en username in deze file bereikbaar maken
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($connection, $id);

    // informatie voor de post waarbij de id hetzelfde is, zodat het dezelfde post is.
    $sql = "SELECT * FROM Posts JOIN `Users` u on Posts.user = u.ID WHERE postid = '$id'";
    $result = mysqli_query($connection, $sql);
    $posts = mysqli_fetch_array($result);
    ?>
<div class="user_post_container">
    <div class="user_post_main">
        <div class="user_posts">
            <div class="post" id="post_container" data-id="<?php echo $posts['postid']; ?>">
                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?></p>
                <p><?php echo $posts['category'] ?></p>
                <p>By <?php echo $posts['user'] ?></p>
                <p>Published on: <?php echo $posts['datetime'] ?></p>
                <form action="" method="post">
                    <button name="like_button" style="color:blue" id="likescount"
                        class="likes_count"><?php echo $posts['likes']; ?> Likes</button>
                    <button name="dislike_button" style="color:blue" id="dislikescount"
                        class="dislikes_count"><?php echo $posts['dislikes']; ?> Dislikes</button>
                </form>
                <br>
                <?php
if (isset($_POST['like_button'])) {
        $check_sql = "SELECT * FROM Likes WHERE userid = '$like_user_id' AND postid=" . $posts['postid'] . "";
        $like_results = mysqli_query($connection, $check_sql);
        if (mysqli_num_rows($like_results) == 1) {
            ?>
                <!-- user already likes post -->
                <span id="unlike" class="unlike fa fa-thumbs-up" name="like_button"
                    data-id="<?php echo $posts['postid']; ?>"></span>
                <span id="like" class="like hide fa fa-thumbs-o-up" data-id="<?php echo $posts['postid']; ?>"></span>
                <?php } else {?>
                <!-- user has not yet liked post -->
                <span id="like" class="like fa fa-thumbs-o-up" data-id="<?php echo $posts['postid']; ?>"></span>
                <span id="unlike" class="unlike hide fa fa-thumbs-up" name="like_button"
                    data-id="<?php echo $posts['postid']; ?>"></span>
                <?php }
    }

    if (isset($_POST['dislike_button'])) {
        $dislike_results = mysqli_query($connection, "SELECT * FROM Dislikes WHERE userid = '$like_user_id' AND postid=" . $posts['postid'] . "");
        if (mysqli_num_rows($dislike_results) == 1) {
            ?>
                <!-- user has not yet disliked post -->
                <span class="undislike fa fa-thumbs-down" data-id="<?php echo $posts['postid']; ?>"></span>
                <span class="dislike hide fa fa-thumbs-o-down" data-id="<?php echo $posts['postid']; ?>"></span>
                <?php } else {?>
                <!-- user already has disliked post -->
                <span class="dislike fa fa-thumbs-o-down" data-id="<?php echo $posts['postid']; ?>"></span>
                <span class="undislike hide fa fa-thumbs-down" data-id="<?php echo $posts['postid']; ?>"></span>
                <?php }
    }?>
            </div>
            <div class="comment_content">
                <div class="wrapper">
                    <form action="" method="post" class="form">
                        <textarea name="message" value="message" cols="30" rows="1" class="comment_message"
                            placeholder="Comment..."></textarea>
                        <button type="submit" value="Post" class="comment_btn" name="submit_comment">Submit
                            Comment</button>
                    </form>
                </div>
            </div>
            <?php
$comments = "SELECT * FROM `Comments` c JOIN Users u WHERE postid = '$id' AND u.ID = c.userid";
    $comment_results = $connection->query($comments);

    if ($comment_results->num_rows > 0) {
        // output data of each row
        while ($row = $comment_results->fetch_assoc()) {?>
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
</div>
<?php
} else {
    // Scherm voor degene die nog niet ingelogd is.
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

<script src="jquery-3.6.3.min.js"></script>
<script>
$(document).ready(function() {
    // when the user clicks on like
    $('#like').on('click', function() {
        var postid = $(this).data('id');
        $post = $(this);

        $.ajax({
            url: 'async.php',
            type: 'post',
            data: {
                'liked': 1,
                'postid': postid
            },
            success: function(response) {
                console.log("LIKE RESPONSE: ", response);
                $post.parent().find('#likescount').text(response + " Likes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');
            }
        });
    });

    // when the user clicks on unlike
    $('#unlike').on('click', function() {
        var postid = $(this).data('id');
        $post = $(this);
        $.ajax({
            url: 'async.php',
            type: 'post',
            data: {
                'unliked': 1,
                'postid': postid
            },
            success: function(response) {
                $post.parent().find('#likescount').text(response + " Likes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');
            }
        });
    });
});


$(document).ready(function() {
    // when the user clicks on like
    $('.dislike').on('click', function() {
        var postid = $(this).data('id');
        $post = $(this);

        $.ajax({
            url: 'async.php',
            type: 'post',
            data: {
                'disliked': 1,
                'postid': postid
            },
            success: function(response) {
                $post.parent().find('#dislikescount').text(response + " dislikes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');
            }
        });
    });

    // when the user clicks on unlike
    $('.undislike').on('click', function() {
        var postid = $(this).data('id');
        $post = $(this);

        $.ajax({
            url: 'async.php',
            type: 'post',
            data: {
                'undisliked': 1,
                'postid': postid
            },
            success: function(response) {
                $post.parent().find('#dislikescount').text(response + " dislikes");
                $post.addClass('hide');
                $post.siblings().removeClass('hide');
            }
        });
    });
});
</script>