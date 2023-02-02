<?php
include "header.php";
include "../../connection.php";

// id en username in deze file bereikbaar maken
$id = mysqli_real_escape_string($connection, $_GET['id']);
$username = mysqli_real_escape_string($connection, $_GET['username']);
$user_id = 

// real_escape_query ofzo
// informatie voor de post waarbij de id hetzelfde is, zodat het dezelfde post is.
$sql = "SELECT * FROM Posts WHERE postid = '$id'";
$result = mysqli_query($connection, $sql);
$posts = $result->fetch_assoc();

// Comments in de database inserten
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    $comment = "INSERT INTO Comments (`id`, `message`, `postid`) VALUES (NULL, '$message', '$id')";
    $comment_result = mysqli_query($connection, $comment);
}

// Kijken wie het is, admin, user of bezoeker
if (array_key_exists("login_user", $_SESSION)) {
    $user_id = mysqli_real_escape_string($connection, $_SESSION['login_user']);
    $admin = "SELECT * FROM Users WHERE user = '$user_id'";
    $admin_result = mysqli_query($connection, $admin);
    $admin_check = mysqli_fetch_array($admin_result, MYSQLI_ASSOC);
}

// if statement voor de admin om posts te verwijderen
if (isset($_POST['submitdelete'])) {
    $delete = "DELETE FROM Posts WHERE postid = '$id'";
    mysqli_query($connection, $delete);
    header("Location:index.php");
}
?>

<link rel="stylesheet" href="user_post.css">
<div class="posts">
    <?php
if (array_key_exists("login_user", $_SESSION) and $admin_check['isadmin'] == 1) {
    ?>
    <div class="post">
        <div class="container">
            <h2><?php echo $posts['title'] ?></h2>
            <p><?php echo $posts['contents'] ?></p>
            <p><?php echo $posts['category'] ?></p>
            <p>By <?php echo $username ?></p>
        </div>
        <div class="extra" style="position:relative;">
            <span class="extrainfo">
                <?php echo $posts['likes'] ?> Likes | Published on: <?php echo $posts['datetime'] ?>
            </span>
            <form action="" method="post">
                <input class="button" type="submit" name="submitdelete" value="delete">
            </form>
        </div>
    </div>
</div>
<?php
} else {
    ?>

<div class="post">
    <div class="container">
        <h2><?php echo $posts['title'] ?></h2>
        <p><?php echo $posts['contents'] ?>
        <p>
        <p><?php echo $posts['category'] ?></p>
        <p>By <?php echo $username ?></p>
    </div>
    <div class="extra" style="position:relative;">
        <span class="extrainfo">
            <?php echo $posts['likes'] ?> Likes | Published on: <?php echo $posts['datetime'] ?>
        </span>
    </div>
</div>
</div>
<?php
}
?>

<div class="content">
    <div class="wrapper">
        <form action="" method="post" class="form">
            <textarea name="message" value="message" cols="30" rows="1" class="message"
                placeholder="Comment..."></textarea>
            <button type="submit" value="Post" class="btn" name="submit_comment">Submit Comment</button>
        </form>
    </div>
    <?php
$comments = "SELECT * FROM Comments WHERE postid = $id";
$comment_result = $connection->query($comments);

if ($comment_result->num_rows > 0) {
    // output data of each row
    while ($row = $comment_result->fetch_assoc()) {?>
    <p><?php echo $row['message']; ?></p>
    <?php
}
}
?>

<?php include "footer.php";?>