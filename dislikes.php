<?php 
	include '../../connection.php';

if (isset($_POST['disliked'])) {
		$postid = mysqli_real_escape_string($connection, $_POST['postid']);
		$result = mysqli_query($connection, "SELECT * FROM Posts WHERE postid=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['dislikes'];

		mysqli_query($connection, "INSERT INTO Dislikes (userid, postid) VALUES (1, $postid)");
		mysqli_query($connection, "UPDATE Posts SET dislikes=$n+1 WHERE postid=$postid");

		echo $n+1;
		exit();
	}
	if (isset($_POST['unliked'])) {
		$postid = mysqli_real_escape_string($connection, $_POST['postid']);
		$result = mysqli_query($connection, "SELECT * FROM Posts WHERE postid=$postid");
		$row = mysqli_fetch_array($result);
		$n = $row['dislikes'];

		mysqli_query($connection, "DELETE FROM Dislikes WHERE postid=$postid AND userid=1");
		mysqli_query($connection, "UPDATE Posts SET dislikes=$n-1 WHERE postid=$postid");
		
		echo $n-1;
		exit();	
	}

	// Retrieve posts from the database
	$posts = mysqli_query($connection, "SELECT * FROM Posts");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dislike system</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="dislikes.css">
</head>
<body>
	<!-- display posts gotten from the database  -->
		<?php while ($row = mysqli_fetch_array($posts)) { ?>

			<div class="post">
				<?php echo $row['title'];?> <br>
				<?php echo $row['contents']; ?> <br>
				<?php echo $row['datetime']; ?> <br>

				<div style="padding: 2px; margin-top: 5px;">
				<?php 
					// determine if user has already disliked this post
					$results = mysqli_query($connection, "SELECT * FROM Dislikes WHERE userid=1 AND postid=".$row['postid']."");

					if (mysqli_num_rows($results) == 1 ): ?>
						<!-- user already dislikes post -->
						<span class="unlike fa fa-thumbs-down" data-id="<?php echo $row['postid']; ?>"></span> 
						<span class="like hide fa fa-thumbs-o-down" data-id="<?php echo $row['postid']; ?>"></span> 
					<?php else: ?>
						<!-- user has not yet disliked post -->
						<span class="like fa fa-thumbs-o-down" data-id="<?php echo $row['postid']; ?>"></span> 
						<span class="unlike hide fa fa-thumbs-down" data-id="<?php echo $row['postid']; ?>"></span> 
					<?php endif ?>

					<span class="dislikes_count"><?php echo $row['dislikes']; ?> dislikes</span>
				</div>
			</div>

		<?php } ?>


<!-- Add Jquery to page -->
<script src="jquery-3.6.3.min.js"></script>
<script>
	$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var postid = $(this).data('id');
			    $post = $(this);

			$.ajax({
				url: 'dislikes.php',
				type: 'post',
				data: {
					'disliked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.dislikes_count').text(response + " dislikes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		// when the user clicks on unlike
		$('.unlike').on('click', function(){
			var postid = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url: 'dislikes.php',
				type: 'post',
				data: {
					'unliked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.dislikes_count').text(response + " dislikes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});
	});
</script>
</body>
</html>