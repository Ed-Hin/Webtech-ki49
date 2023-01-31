<?php
include "header.php";
include("../../connection.php");

    $id = $_GET['id'];
    $username = $_GET['username'];
    $sql = "SELECT * FROM Posts WHERE postid = '$id'";
    $result = mysqli_query($connection,$sql);
    $posts = $result->fetch_assoc();
?>

<?php

    $message = $_POST['message'];

    if (isset($_POST['submit_comment'])) {

        $sql = "INSERT INTO comments (message)
        VALUES ('$message')";

        if ($connection->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }

?>
    
    <link rel="stylesheet" href="user_post.css">
    <div class="posts">
            <div class="post">
                <div class="container">
                <h2><?php echo $posts['title'] ?></h2>
                <p><?php echo $posts['contents'] ?><p>
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
        <?php } } ?>

    </div>


<?php include "footer.php"; ?>