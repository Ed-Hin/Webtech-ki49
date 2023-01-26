<?php
include "header.php";
include "footer.php";
?>
<?php
include '../../connection.php';

$category = mysqli_real_escape_string($connection, htmlspecialchars($_POST["category"]));
$title = mysqli_real_escape_string($connection, htmlspecialchars($_POST["title"]));
$contents = mysqli_real_escape_string($connection, htmlspecialchars($_POST["contents"]));

try {
$sql = "INSERT INTO Posts (category, title, contents) VALUES ('$category', '$title', '$contents')";
mysqli_query($connection, $sql);
} catch(PDOExeption $e) {
    echo $sql . "<br>" . $e->getMessage();
}
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
         <!--Filter Box-->
        <div class="filter-box">
           <select name="" id="">
        <form action="post.php" method="post">
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
            <label for="content">Content</label>
            <br><br>
            <textarea type="text" id="content" name="content" placeholder="Content.."></textarea><br>
            <input type="submit" value="Submit">



        </form>



    </div>







</body>

</html>