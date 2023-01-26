<?php
include "header.php";
include "footer.php";
?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <link rel="stylesheet" href="post.css">

</head>
<body>
    <br><br>


    <h1>Create your post</h1>
    <br><br>
    <form>
         <!--Filter Box-->
        <div class="filter-box">
            <select name="" id="">
                <option value="Select topic" id="Selecttopic">Select topic..</option>
                <option value="Cars">Cars</option>                        <option value="Pets">Pets</option>
                <option value="Food">Food</option>
                <option value="Memes">Memes</option>
                <option value="Politics">Politics</option>
                <option value="Music">Music</option>
            </select>
        </div>
    <br><br>
        <div class="post-box">
            <label for="title">Title</label><br><br>
            <textarea type="text" id="title" name="title" placeholder="Title.."></textarea><br><br>
            <label for="content">Content</label>            <br><br>
            <textarea type="text" id="content" name="content" placeholder="Content.."></textarea><br>
            <input type="submit" value="Post">



    </form>



    </div>







</body>

</html>