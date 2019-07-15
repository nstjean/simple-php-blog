<?php
	require('config/config.php');
	require('config/db.php');

	// messages
	$msg = '';
	$msgClass = '';

	if(!isset($_GET['id'])) {
		header('Location: '.ROOT_URL.'index.php');
	}

	$id = mysqli_real_escape_string($connection, $_GET['id']);

	if(isset($_POST['submit'])) {
		$title = filter_var(mysqli_real_escape_string($connection, $_POST['title']), FILTER_SANITIZE_STRING);
		$author = filter_var(mysqli_real_escape_string($connection, $_POST['author']), FILTER_SANITIZE_STRING);
		$body = filter_var(mysqli_real_escape_string($connection, $_POST['body']), FILTER_SANITIZE_STRING);
		if(!empty($title) && !empty($author) && !empty($body)) {
			// all fields are present

			$query = "UPDATE posts SET title='$title', author='$author', body='$body' WHERE id=$id";

			if(mysqli_query($connection, $query)) {
				$msg = 'Post Updated';
				$msgClass = 'alert-success';
				$msgString = '?msg='.$msg.'?msgClass='.$msgClass;
				header('Location: '.ROOT_URL.'index.php'.$msgString);
			} else {
				$msg = 'ERROR: ' . mysqli_error($connection);
				$msgClass = 'alert-danger';
			}
		} else {
			$msg = 'One or more inputs are empty';
			$msgClass = 'alert-danger';
		}
	} else {
		$query = "SELECT * FROM posts WHERE id=".$id;
		$result = mysqli_query($connection, $query);
		$post = mysqli_fetch_assoc($result);
		mysqli_free_result($result);
		mysqli_close($connection);
		$title = $post['title'];
		$author = $post['author'];
		$body = $post['body'];
	}
?>
<?php include('includes/header.php'); ?>

	<h1>Add Post</h1>

	<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" name="title" class="form-control" value="<?php echo isset($title) ? $title : '' ?>">
		</div>
		<div class="form-group">
			<label for="author">Author</label>
			<input type="text" name="author" class="form-control" value="<?php echo isset($author) ? $author : '' ?>">
		</div>
		<div class="form-group">
			<label for="body">Body</label>
			<textarea name="body" class="form-control"><?php echo isset($body) ? $body : '' ?></textarea>
		</div>
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<input type="submit" name="submit" value="Submit" class="btn btn-primary">
	</form>

<?php include('includes/footer.php'); ?>