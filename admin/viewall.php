<?php 
include 'check.php';
if (!isset($_GET['id'])) {
	$id = 0;
} else {
	if($_GET['id'] < 0){
		$id = 0;
	} else {
		$id = $_GET['id'];
	}
	


}
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
			<input type="submit" value="Logout">
		</form>
	</div>
	
<?php
		$postsArray = array();
		$postsArray = getPostsByDiapazone($id);
		if(!	($postsArray)) {
			echo "<h1>No Posts with " . $id . " - " . ($id + 5) . "</h1>";
		}
		$len = count($postsArray);
		$i = 0;
		while($i < $len) {
			echo "<div class='post'>";
			echo "<form action='editpost.php' method='get'>";
			echo "<h1>" . $postsArray[$i]->getTitle() . "</h1>";
			echo "<h3>" . $postsArray[$i]->getDate() . "</h3>";
			if(strlen($postsArray[$i]->getContent()) > 100) {
				echo "<p>"  . substr($postsArray[$i]->getContent(), 0, 100) . "...</p>";	
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
	<?php
		echo "<input name='id' class='hidden' value='" . ($id + 5) . "'>";
	
		echo "<input type='submit' value='Next 5 >'>"
	?>
	</form>
	<form>
	<?php
		echo "<input name='id' class='hidden' value='" . ($id - 5) . "'>";
	
		echo "<input type='submit' value='< Previous 5 '>"
	?>
	</form>
</body>
</html>