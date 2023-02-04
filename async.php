<?php
session_start();
include "../../connection.php";

if (isset($_POST['liked'])) {
    $postid = mysqli_real_escape_string($connection, $_POST['postid']);

    $user_info = $_SESSION['login_user'];
    $user_info = mysqli_real_escape_string($connection, $user_info);
    $user_sql = "SELECT * FROM Users where user = '$user_info'";
    $user_result = mysqli_query($connection, $user_sql);
    $info = mysqli_fetch_array($user_result);
    $like_user_id = $info['ID'];
    $like_user_id = mysqli_real_escape_string($connection, $like_user_id);

    $like_sql = "SELECT * FROM Posts WHERE postid = '$postid'";
    $result = mysqli_query($connection, $like_sql);
    $row = mysqli_fetch_array($result);
    $n = $row['likes'];
    $inc_n = $n + 1;

    mysqli_query($connection, "INSERT INTO `Likes` (`userid`, `postid`) VALUES ('$like_user_id', '$postid')");
    mysqli_query($connection, "UPDATE Posts SET likes=$inc_n WHERE postid=$postid");

    echo $inc_n;
}

if (isset($_POST['unliked'])) {
    $postid = mysqli_real_escape_string($connection, $_POST['postid']);
    $user_info = $_SESSION['login_user'];
    $user_info = mysqli_real_escape_string($connection, $user_info);
    $user_sql = "SELECT * FROM Users where user = '$user_info'";
    $user_result = mysqli_query($connection, $user_sql);
    $info = mysqli_fetch_array($user_result);
    $like_user_id = $info['ID'];
    $like_user_id = mysqli_real_escape_string($connection, $like_user_id);

    $unlike_sql = "SELECT * FROM Posts WHERE postid = '$postid'";
    $unlike_result = mysqli_query($connection, $unlike_sql);
    $unlike_row = mysqli_fetch_array($unlike_result);
    $n = $unlike_row['likes'];
    $dec_n = $n - 1;

    mysqli_query($connection, "DELETE FROM Likes WHERE postid = '$postid' AND userid = '$like_user_id'");
    mysqli_query($connection, "UPDATE Posts SET likes=$dec_n WHERE postid = '$postid'");

    echo $dec_n;
}

if (isset($_POST['disliked'])) {
    $postid = mysqli_real_escape_string($connection, $_POST['postid']);

    $user_info = $_SESSION['login_user'];
    $user_info = mysqli_real_escape_string($connection, $user_info);
    $user_sql = "SELECT * FROM Users where user = '$user_info'";
    $user_result = mysqli_query($connection, $user_sql);
    $info = mysqli_fetch_array($user_result);
    $like_user_id = $info['ID'];
    $like_user_id = mysqli_real_escape_string($connection, $like_user_id);

    $like_sql = "SELECT * FROM Posts WHERE postid = '$postid'";
    $result = mysqli_query($connection, $like_sql);
    $row = mysqli_fetch_array($result);
    $n = $row['dislikes'];
    $inc_n = $n + 1;

    mysqli_query($connection, "INSERT INTO `Dislikes` (`userid`, `postid`) VALUES ('$like_user_id', '$postid')");
    mysqli_query($connection, "UPDATE Posts SET dislikes=$inc_n WHERE postid=$postid");

    echo $inc_n;
}

if (isset($_POST['undisliked'])) {
    $postid = mysqli_real_escape_string($connection, $_POST['postid']);

    $user_info = $_SESSION['login_user'];
    $user_info = mysqli_real_escape_string($connection, $user_info);
    $user_sql = "SELECT * FROM Users where user = '$user_info'";
    $user_result = mysqli_query($connection, $user_sql);
    $info = mysqli_fetch_array($user_result);
    $like_user_id = $info['ID'];
    $like_user_id = mysqli_real_escape_string($connection, $like_user_id);

    $unlike_sql = "SELECT * FROM Posts WHERE postid = '$postid'";
    $unlike_result = mysqli_query($connection, $unlike_sql);
    $unlike_row = mysqli_fetch_array($unlike_result);
    $n = $unlike_row['dislikes'];
    $dec_n = $n - 1;

    mysqli_query($connection, "DELETE FROM Dislikes WHERE postid = '$postid' AND userid = '$like_user_id'");
    mysqli_query($connection, "UPDATE Posts SET dislikes=$dec_n WHERE postid = '$postid'");

    echo $dec_n;
}