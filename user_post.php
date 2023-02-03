<?php
include "header.php";
include "../../connection.php";

$like_user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);

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
    header("location:index.php");
}

// Comments in de database inserten
if (isset($_POST['submit_comment'])) {
    $id = $_GET['id'];
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    $comment_user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);
    $comment = "INSERT INTO Comments (`id`, `message`, `postid`, `userid`) VALUES (NULL, '$message', '$id', '$comment_user_id')";
    $comment_results = mysqli_query($connection, $comment);
    }
}

if (isset($_POST['liked'])) {
    $postid = $_POST['postid'];
    $user_info = $_SESSION['login_user'];
    $user_info = mysqli_real_escape_string($connection, $user_info);
    $user_sql = "SELECT * FROM Users where user = '$user_info'";
    $user_result = mysqli_query($connection,$sql);
    $info = mysqli_fetch_array($user_result);
    $like_user_id = $info['ID'];
    
    $like_sql = "SELECT * FROM Posts WHERE postid = '$postid'";
    $result = mysqli_query($connection, $like_sql);
    $row = mysqli_fetch_array($result);
    $n = $row['likes'];
    $inc_n = $n+1;

    mysqli_query($connection, "INSERT INTO `Likes` (`userid`, `postid`) VALUES ('$like_user_id', '$postid')");
    mysqli_query($connection, "UPDATE Posts SET likes= '$inc_n' WHERE postid = '$postid'");

    echo $inc_n;
    exit();
}

if (isset($_POST['unliked'])) {
    $postid = $_POST['postid'];
    $user_info = mysqli_real_escape_string($connection, $postid);
    $user_info = $_SESSION['login_user'];
    $user_info = mysqli_real_escape_string($connection, $user_info);
    $user_sql = "SELECT * FROM Users where user = '$user_info'";
    $user_result = mysqli_query($connection,$sql);
    $info = mysqli_fetch_array($user_result);
    $like_user_id = $info['ID'];
    $user_info = mysqli_real_escape_string($connection, $like_user_id);

    $unlike_sql = "SELECT * FROM Posts WHERE postid = '$postid'";
    $unlike_result = mysqli_query($connection, $unlike_sql);
    $unlike_row = mysqli_fetch_array($unlike_result);
    $n = $unlike_row['likes'];
    $dec_n = $n-1;

    mysqli_query($connection, "DELETE FROM Likes WHERE postid = '$postid' AND userid = '$like_user_id'");
    mysqli_query($connection, "UPDATE Posts SET likes = '$dec_n' WHERE postid = '$postid'");

    echo $dec_n;
    exit();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="user_post.css">

<?php
if (array_key_exists("login_user", $_SESSION) and $admin_check['isadmin'] == 1) {
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
        <div class="posts">
            <div class="post" id="post_container" data-id="<?php echo $posts['postid']; ?>">
                
                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?></p>
                <p><?php echo $posts['category'] ?></p>
                <p>By <?php echo $posts['user'] ?></p>
                        <?php 
                        $check_sql = "SELECT * FROM Likes WHERE userid = '$like_user_id' AND postid=".$posts['postid']."";
                        $results = mysqli_query($connection, $check_sql);
                        if (mysqli_num_rows($results) == $like_user_id): 
                        ?>
                        <!-- user already likes post -->
                        <span id="decrement-like" class="unlike fa fa-thumbs-up" data-id="<?php echo $posts['postid']; ?>"></span>
                        <span id="increment-like"class="like hide fa fa-thumbs-o-up" data-id="<?php echo $posts['postid']; ?>"></span>
                    <?php else: ?>
                        <!-- user has not yet liked post -->
                        <span id="increment-like" class="like fa fa-thumbs-o-up" data-id="<?php echo $posts['postid']; ?>"></span>
                        <span id="decrement-flike"class="unlike hide fa fa-thumbs-up" data-id="<?php echo $posts['postid']; ?>"></span>
                        <?php endif ?>
                    <div class="extra" style="position:relative;">
                    <span class="extrainfo">
                        <span id="likescount" class="likes_count"><?php echo $posts['likes']; ?></span>
                    </span>
                    <p>Published on: <?php echo $posts['datetime'] ?></p>
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
<?php
} elseif (array_key_exists("login_user", $_SESSION)) {
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
            <textarea name="message" value="message" cols="30" rows="1" class="comment_message"
                placeholder="Comment..."></textarea>
            <button type="submit" value="Post" class="comment_btn" name="submit_comment">Submit Comment</button>
        </form>
    </div>
</div>

<?php
    $comments = "SELECT * FROM Comments c JOIN Users u WHERE postid = $id AND u.ID = c.userid";
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


<script src="jquery-3.6.3.min.js"></script>
    <script>
    // $(document).ready(function() {
    //     // when the user clicks on like
    //     $('.like').on('click', function() {
    //         var postid = $(this).data('id');
    //         $post = $(this);

    //         $.ajax({
    //             url: 'user_post.php',
    //             type: 'post',
    //             data: {
    //                 'liked': 1,
    //                 'postid': postid    
    //             },
    //             success: function(response) {
    //                 console.log(response);
    //                 $post.parent().find('span.likes_count').text(<?php $posts['likes'] ?>);
    //                 $post.addClass('hide');
    //                 $post.siblings().removeClass('hide');
    //             }
    //         });
    //     });

    //     // when the user clicks on unlike
    //     $('.unlike').on('click', function() {
    //         var postid = $(this).data('id');
    //         $post = $(this);

    //         $.ajax({
    //             url: 'user_post.php',
    //             type: 'post',
    //             data: {
    //                 'unliked': 1,
    //                 'postid': postid
    //             },
    //             success: function(response) {
    //                 console.log(response);
    //                 $post.parent().find('span.likes_count').text(<?php $posts['likes'] ?>);
    //                 $post.addClass('hide');
    //                 $post.siblings().removeClass('hide');
    //             }
    //         });
    //     });
    // });


    $(document).ready(function() {
    // initially grab the database value and present it to the view
        var postid = $('#post_container').attr('data-id');
        // console.log("postid ", postid);
    $('#likescount').text(getDatabaseValue(postid));

    $('#increment-like').on('click', function() {
        var postid = $(this).data('id');
        incrementDatabaseValue(postid);
    });
    
    $('#decrement-like').on('click', function() {
        var postid = $(this).data('id');
        decrementDatabaseValue(postid);
    });
});


function getDatabaseValue(postid) {
     $.post("async.php",
        {
            get_likes: true,
            postid: postid
        },
        function (data, status) {
            // check status here
            //return value
        // console.log(data);
        return data;
        });
}

function incrementDatabaseValue(postid) {
     $.post("async.php",
        {
            like: true,
            postid: postid
        },
        function (data, status) {
            // check status here
        
        // update view
        $('#likescount').text(getDatabaseValue(postid));
        });
}

function decrementDatabaseValue(postid) {
     $.post("async.php",
        {
            unlike: true,
            postid: postid
        },
        function (data, status) {
            // check status here

        // update view
        $('#likescount').text(getDatabaseValue(postid));
        });
}

    </script>

<?php include "footer.php";?>