<?php
include 'database.php';
$conn = openConn();
$name = $_POST['reg-name'];
$pass = md5(md5($_POST['reg-pass']));

function availableName($_name, $_conn)
{
	$query =  'SELECT `username` FROM `users` WHERE `username` = "' . mysql_escape_string($_name) . '"';
	$result = $_conn->query($query);
	if($result != false)
	{
		if($result->num_rows > 0) {
			return false;
		} else {
			return true;
		}
	} else {
		return true;
	}
}

function addUser($_name, $_pass, $_conn)
{
	/*
		Default role for user is 2
		Admin 777
	*/
	$_conn = openConn();
	$query = 'INSERT INTO `users`(`username`, `password`, `role`) VALUES ("'. mysql_escape_string($_name) . '", "'. $_pass .'","2")';
	$result = $_conn->query($query);
}

$avail = availableName($name, $conn);
echo $avail;
if($avail == true) {
	addUser($name, $pass, $conn);
	header("Location: ../index.php");
} else {
	echo "<h1>Username is already taken</h1>";
}
?>