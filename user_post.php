<?php
include "header.php";
include("../../connection.php");

    $id = $_GET['id'];
    $username = $_GET['username'];
    $sql = "SELECT * FROM Posts WHERE postid = '$id'";
    $result = mysqli_query($connection,$sql);
    $posts = $result->fetch_assoc();

    if (array_key_exists("login_user", $_SESSION)) {
        $admin_check= $_SESSION['login_user'];
        $admin = "SELECT * FROM Users WHERE user = '$admin_check'";
        $Edmin = mysqli_query($connection,$admin);
        $user_info = mysqli_fetch_array($Edmin,MYSQLI_ASSOC);
    }

?>

<link rel="stylesheet" href="user_post.css">
<div class="posts">
    <?php
        if (array_key_exists("login_user", $_SESSION) and $user_info['isadmin'] == 1) {
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
            <span class="extrainfo">10001 Likes | Published on: <?php echo $posts['datetime'] ?></span>
            <form action="" method="post">
            <input class="button" type="submit" name="submitdelete" value="delete">
        </form>
        <?php if(isset($_POST['submitdelete'])) {
                        $delete = "DELETE FROM Posts WHERE postid = '$id'";
                        mysqli_query($connection, $delete);
                        header("Location:index.php");
                    } ?>
        </div>
    </div>
</div>

<div class="wrapper">
    <form action="" method="post" class="form">
        <textarea name="message" cols="30" rows="1" class="message" placeholder="Comment..."></textarea>
        <button type="submit" class="btn" name="submit_comment">Submit Comment</button>
    </form>
</div>

<h3> Comments </h3>
<div class="content">
    <?php
            $sql = "SELECT * FROM comments";
            $result = $connection->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
        ?>
    <p><?php echo $row['message']; ?></p>
    <?php } } } else { ?>

        <div class="post">
        <div class="container">
            <h2><?php echo $posts['title'] ?></h2>
            <p><?php echo $posts['contents'] ?>
            <p>
            <p><?php echo $posts['category'] ?></p>
            <p>By <?php echo $username ?></p>
        </div>
        <div class="extra" style="position:relative;">
            <span class="extrainfo">10001 Likes | Published on: <?php echo $posts['datetime'] ?></span>
        </div>
    </div>
</div>

<div class="wrapper">
    <form action="" method="post" class="form">
        <textarea name="message" cols="30" rows="1" class="message" placeholder="Comment..."></textarea>
        <button type="submit" class="btn" name="submit_comment">Submit Comment</button>
    </form>
</div>

<h3> Comments </h3>
<div class="content">
    <?php
            $sql = "SELECT * FROM comments";
            $result = $connection->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                
        ?>
    <p><?php echo $row['message']; ?></p>
    <?php } } }?>
</div>

<?php include "footer.php"; ?>