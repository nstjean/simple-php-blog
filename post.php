<?php
	require('config/config.php');
	require('config/db.php');

	if(isset($_POST['delete'])) {
		$delete_id = mysqli_real_escape_string($connection, $_POST['id']);
		$query = "DELETE FROM posts WHERE id=$delete_id";

		if(mysqli_query($connection, $query)) {
			$msg = 'Post Delete';
			$msgClass = 'alert-success';
			$msgString = '?msg='.$msg.'?msgClass='.$msgClass;
			header('Location: '.ROOT_URL.'index.php'.$msgString);
		} else {
			$msg = 'ERROR: ' . mysqli_error($connection);
			$msgClass = 'alert-danger';
		}
	}

	$id = mysqli_real_escape_string($connection, $_GET['id']);
	$query = "SELECT * FROM posts WHERE id=".$id;
	$result = mysqli_query($connection, $query);
	$post = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	mysqli_close($connection);
?>
<?php include('includes/header.php'); ?>

<h1><?php echo $post['title']; ?></h1>
<small>
	Created on <?php echo date('n/d/y \a\t g:ia', strtotime($post['created_at'])); ?>
	by <?php echo $post['author']; ?>
</small>
<div class="my-3">
	<?php echo $post['body']; ?>
</div>
<div class="row d-flex">
	<a class="btn btn-primary" href="<?php echo ROOT_URL . 'editpost.php?id=' . $id ?>">Edit</a>

	<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="mx-3">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<input type="submit" name="delete" value="Delete" class="btn btn-danger">
	</form>

	<a class="btn btn-secondary ml-auto" href="<?php echo ROOT_URL; ?>index.php">Back</a>
</div>

<?php include('includes/footer.php'); ?>