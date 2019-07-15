<!DOCTYPE html>
<html>
	<head>
		<title>MySQLi PHP DB Example</title>
		<link href="bootstrap.min.css" rel="stylesheet">
	</head>
	<body>

		<nav class="nav navbar-dark navbar-expand-md bg-primary p-1 px-3">
				<a class="navbar-brand" href="<?php echo ROOT_URL; ?>index.php">MySQLi PHP Blog</a>
				<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
			    <ul class="navbar-nav mr-auto">
			    	<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
			    	</li>
			    	<li class="nav-item">
						<a class="nav-link" href="addpost.php">Add Post</a>
			    	</li>
				</ul>
			</div>
		</nav>

		<div class="container my-3">

			<?php if(isset($msg) && $msg != ''): ?>
				<div class="alert <?php echo $msgClass; ?>">
					<?php echo $msg; ?>
				</div>
			<?php endif ?>
