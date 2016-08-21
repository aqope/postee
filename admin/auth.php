<?php
include '../class/database.php';
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}	

function login()
{
$conn = openConn();
$user = $_POST['username'];
$pass = $_POST['password'];
$pass = md5(md5($pass));
$query = "SELECT * FROM `users` WHERE `username` = '". $user . "'";
$result = $conn->query($query);
if($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	echo $pass . "=" . $row['password'];
	if( !($pass == $row['password'])) {
		echo "Invalid Username/Password";
		echo "<a href='../index.php'><button> Return</button></a>";
	}
	$hash = md5(generateCode(10));
	
	$query = "UPDATE `users` SET `hash` = '" . $hash . "' WHERE `id` = " . $row['id'];
	$conn->query($query);
	setcookie("id", $row['id'], time()+60*60*24*30);
	setcookie("hash", $hash, time()+60*60*24*30);
	header("Location: index.php");
} else {
	echo "Invalid Username/Password";
	echo "<a href='../index.php'><button> Return</button></a>";
}
}
function logout() 
{
	$conn = openConn();	
	$query="UPDATE `users` SET `hash` = '' WHERE `id` = " . $_COOKIE['id'];
	$result = $conn->query($query);
	setcookie("id", "", time() - 3600*24*30*12, "/");
    setcookie("hash", "", time() - 3600*24*30*12, "/");
    header("Location: ../index.php");
}

if($_POST['action_user'] == 'login') {
	login();
}
if($_POST['action_user'] == 'logout') {
	logout();
}

?>