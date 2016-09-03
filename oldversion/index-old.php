
<?php
/**
 * Copyright <c>  Artur Paklin
 * paklin.artur@gmail.com
 */
include 'class/database.php';
// include 'class/posts.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple Blog</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
<div class="page-wrapper">
	<div class="header">
		<div id="log-in">
		<form action="admin/auth.php" method="POST">
			<label>username:</label>
			<input name="username" type="text">
			<label>password:</label>
			<input name="password" type="password">
			<input class="hidden" name="action_user" value="login">
			<button class="icon  login" type="submit">&nbsp;</button>
			<!--  -->
		</form>
		<a href="#"><button href="#" class="icon text register">Register</button></a>
		</div>
	</div>
	<div class="main">
		<div class="page-posts">
			<?php
			/**
			 * Renders latest posts
			 */
			$postsArray = array();
			$postsArray = getLatestPosts();
			$len = count($postsArray);
			$i = 0;
			while($i < $len) {
				echo "<div class='post'>";
				echo "<form action='viewpost.php' method='get'>";
				echo "<h1>" . $postsArray[$i]->getTitle() . "</h1>";
				echo "<h3>" . $postsArray[$i]->getDate() . "</h3>";
				if(strlen($postsArray[$i]->getContent()) > 1400) {
					echo "<p>"  . substr($postsArray[$i]->getContent(), 0, 1400) . "...</p>";
				} else {
					echo "<p>"  . $postsArray[$i]->getContent() . "</p>";
				}
				echo "<input class='hidden' name='id' value='". $postsArray[$i]->getRecID() .  "'>";
				echo "<button class='icon text view_more' type='submit'>Read more</button>";
				echo "</form>";
				echo "</div>";
				$i = $i + 1;
			}
			?>
		</div>
		<div class="menu-tags">
			<h2>Tags</h2>
			<a href="#">alpha</a>
			<a href="#">centaur</a>
			<a href="#">get</a>
			<a href="#">sfs</a>
		</div>
	</div>

	<div class="footer">
		<h1>Copyright &lt;c&gt; Artur Paklin - 2016</h1>
	</div>
</div>

</body>
</html>