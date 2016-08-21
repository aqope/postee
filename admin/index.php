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
		<form action="auth.php" method="POST">
			<input class="hidden" name="action_user" value="logout">
			<input type="submit" value="logout">
		</form>
	</div>
	
<?php 
		$postsArray = array();
		$postsArray = getLatestPosts();
		$len = count($postsArray);
		$i = 0;
		while($i < $len) {
			echo "<div class='post'>";
			echo "<form action='editpost.php' method='get'>";
			echo "<h1>" . $postsArray[$i]->getTitle() . "</h1>";
			echo "<h3>" . $postsArray[$i]->getDate() . "</h3>";
			if(strlen($postsArray[$i]->getContent()) > 800) {
				echo "<p>"  . substr($postsArray[$i]->getContent(), 0, 800) . "...</p>";	
			} else {
				echo "<p>"  . $postsArray[$i]->getContent() . "</p>";			
			}
			echo "<input class='hidden' name='id' value='". $postsArray[$i]->getRecID() .  "'>";
			echo "<input type='submit' value='Edit Post'>";
			echo "</form>";
			echo "</div>";
			$i = $i + 1;
		}
	?>
	<form action="viewall.php" method="GET">
		<input name='id' class='hidden' value='0'>
		<input type='submit' value='View All'>
	</form>		
</body>
</html>