<?php
include 'check.php';
?>
<?php
$post = getPostById($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple Blog</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
<div class "admin-controls">
		<a href="newpost.php"><button>Add New Post </button></a>
		<form action="handler.php" method="POST">
		<?php
			echo "<input name='id' class='hidden' value='" . $_GET['id'] . "'>";
		?>
			
			<input name="action" class="hidden" value="delete">
			<input type="submit" value="Delete">
		</form>
	</div>
<?php
			// echo "<div class='post-full'>';
			echo "<form action='handler.php' method='POST'>";
			echo "<h3> Title </h3>";
			echo "<input name ='title'class='title' type='text' value='". $post->getTitle() ."''>";
			echo "<h3> Content </h3>";
			echo "<input name='action' class='hidden' value='update'>";
			echo "<input name='id' class='hidden' value='" . $_GET['id'] . "'>";
			echo "<textarea name='content' class='content' type='text'>". $post->getContent() . "</textarea>";
			echo "<input type='submit' value='Update'>";
			echo "</form>";
			// echo hash("md5", "lol",false);
?>
</body>
</html>