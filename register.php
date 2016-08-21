<?php
include 'class/database.php';
// include 'class/posts.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple Blog</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="page-wrapper">
	<div id="log-in">
	<form action="admin/auth.php" method="POST">
		<label>username:</label>
		<input name="username" type="text">
		<label>password:</label>
		<input name="password" type="password">
		<input class="hidden" name="action_user" value="login">
		<button class="icon login" type="submit">&nbsp;</button>
		<!--  -->
	</form>
	<a href="#"><button href="#" class="icon register">Register</button></a>
	</div>
		<div class="register-form">
			<h2>Register Form</h2>
			<form action="class/users.php" method="POST">
			<div class="input-container">
				<label>username</label>
				<input name="reg-name" type="text">
			</div>
			<div class="input-container">
				<label>password</label>
				<input name="reg-pass" type="text">
			</div>
				<button class="icon text submit" type="submit">Register</button>
			</form>
		</div>
	</div>
</body>
</html>