<?php
    date_default_timezone_set('Europe/Amsterdam');
    include '../../connection.php';
    function setComments($connection) {
        if (isset($_POST['commentSubmit'])) {
            $userid = $_POST['userid'];
            $date = $_POST['date'];
            $comment = $_POST['comment'];

            $sql = "INSERT INTO comments (userid, date, comment) VALUES ('$userid', '$date', '$comment')";
            $result = $connection->query($sql);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Commentsection</title>
    </head>
<body>
    <form method='POST' action='".setComments($connection)."'>
        <input type='hidden' name='userid' value='Anonymous'>
        <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
        <textarea name='comment'></textarea><br>
        <button type='submit' name='commentSubmit'>Comment</button>
    </form>
</body>
</html>