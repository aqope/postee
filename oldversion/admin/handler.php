<?php
	$nonChar = array("!", '"', "$", "%", "'", "(", ")", "*", "+", "-", ".", "/", "<", ">", "=");
	$rplChar = array("&#33", "&#34", "&#36", "&#37", "&#39", "&#40", "&#41", "&#42", "&#43", "&#45", "&#46", "&#47", "&#60", "&#62", "&#61");
	include 'check.php';
	$action = $_POST['action'];	
	if($action == "addnew") {
		$title = $_POST['title'];
		$content = str_replace($nonChar, $rplChar, $_POST['content']);
		$post = new posts($title, $content, date('Y-m-d'));
		addPost($post);
	}
	if($action == "update") {
		$title = $_POST['title'];
		$content = str_replace($nonChar, $rplChar, $_POST['content']);
		$id = $_POST['id'];
		$post = new posts($title, $content, date('Y-m-d'), $id);
		updatePost($post);
	}
	if($action == "delete") {
		$id = $_POST['id'];
		deletePost($id);
	}
		header("Location: index.php");
?>