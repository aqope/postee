<?php
include 'check.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<div class "admin-controls">
		<a href="newpost.php"><button>Add New Post </button></a>
		<a href="index.php"><button> Return</button></a>
	</div>
	<div class='post'>
	<form action="handler.php" method="POST">
		<h3> Title </h3>
		<input name ="title"class="title" type="text">
		<h3> Content </h3>
		<input name="action" class="hidden" value="addnew">
		<textarea name="content" class="content" type="text"></textarea>
		<input type="submit" value="Add Post">
	</form>

	</div>
</body>
</html>