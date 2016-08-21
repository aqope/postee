<?php
include 'posts.php';
	function openConn()
	{
		$dbServer = '127.0.0.1';
		$dbUser = 'root';
		$dbPass = '';
		$dbName = 'blog-db';
		
		$conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);

		if(!$conn) {
			die("Error connecting:" . $conn->connect_error);
		}
		return $conn;
	}
	function getLatestPosts()
	{
		$conn = openConn();
		$query = 'SELECT * FROM `posts` ORDER BY `id` DESC LIMIT 5';
		$postsArray = array();
		$result = $conn->query($query);

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$post = new posts($row['title'], $row['content'], $row['date'], $row['id']);
				$postsArray[] = $post;
			}
		}
	if(!is_null($postsArray)) {
		return $postsArray;
	} else {
		return 0;
	}

	}
	function getPostById($_id)
	{
		$conn = openConn();
		$query = 'SELECT * FROM `posts` WHERE `id` = '. $_id . '';
		$post='';
		$result = $conn->query($query);

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$post = new posts($row['title'], $row['content'], $row['date'], $row['id']);
							
			}
		}
		if(!is_null($post)) {
			return $post;
		} else {
			return 0;
		}
	}

	function getPostsByDiapazone($_startId, $_depth = 6)
	{
		$conn = openConn();
		$query = 'SELECT * FROM `posts` WHERE `id` > '. $_startId . ' AND `id` < '. ($_depth);
		$post='';
		$postsArray = array();
		$result = $conn->query($query);

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$post = new posts($row['title'], $row['content'], $row['date'], $row['id']);
				$postsArray[] = $post;
			}
		}
		if(!is_null($postsArray)) {
			return $postsArray;
		} else {
			die("Posts with do not exist with > " . $_startId);
		}	
	}

	function addPost($post) 
	{
		$conn = openConn();
		$query = "INSERT INTO `posts` VALUES('', '". $post->getTitle() ."', '". $post->getContent() ."', '" . $post->getDate() ."')";
		$result = $conn->query($query);
	}
	function updatePost($post) 
	{
		$conn = openConn();
		$query = "UPDATE `posts` SET `title` = '". $post->getTitle() ."', `content`='". $post->getContent() ."', `date`='" . $post->getDate() ."' WHERE `id` = '" . $post->getRecID() ."'";
		$result = $conn->query($query);
	}
	function deletePost($_id)
	{
		$conn = openConn();
		$query = "DELETE FROM `posts` WHERE `id` = " . $_id . "";
		$result = $conn->query($query);
	}

?>