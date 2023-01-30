<?php
include "header.php";
include "footer.php";
include("../../connection.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $topics = mysqli_real_escape_string($connection, $_POST['topics']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $content = mysqli_real_escape_string($connection, $_POST['content']);
}
if($topics == "Cars") {
    $sql = "SELECT * FROM `Posts` WHERE category = 'Cars'";

}
?>

<link rel="stylesheet" href="topics.css">
<br><br><br><br><br>
    <form action="topics.php" method="get">
        <div class="filter-box">
                    <select name="topics" id="topicslist">
                        <option value="Select topic" id="Selecttopic">Select topic..</option>
                        <option value="Cars">Cars</option>
                        <option value="Pets">Pets</option>
                        <option value="Food">Food</option>
                        <option value="Memes">Memes</option>
                        <option value="Politics">Politics</option>
                        <option value="Music">Music</option>
            </select>
        </div>
    <form>
           
            
            
    </body>
</html>