<?php
	require('config/config.php');
	require('config/db.php');

	$query = "SELECT * FROM posts ORDER BY created_at DESC";
	$result = mysqli_query($connection, $query);
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($connection);
?>
<?php include('includes/header.php'); ?>

	<h1>Posts</h1>
	<?php foreach($posts as $post): ?>
		<div class="card m-3 p-3">
			<h4><?php echo $post['title']; ?></h4>
			<small>
				Created on <?php echo date('n/d/y \a\t g:ia', strtotime($post['created_at'])); ?>
				by <?php echo $post['author']; ?>
			</small>
			<div class="my-3">
				<?php echo $post['body']; ?>
			</div>
			<div>
				<a class="btn btn-small btn-primary" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id'] ?>">More</a>
			</div>
		</div>
	<?php endforeach ?>

<?php include('includes/footer.php'); ?>