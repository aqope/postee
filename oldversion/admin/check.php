<?php
	include '../class/database.php';
	$conn = openConn();

	if(isset($_COOKIE["id"]) && isset($_COOKIE["hash"])) {
		$query="SELECT * FROM `users` WHERE id='". $_COOKIE["id"] ."'";
		$result = $conn->query($query);
		$data = $result->fetch_assoc();
		if($data['hash'] == $_COOKIE["hash"] && $data['id'] == $_COOKIE['id']) {
			echo "Welcome Admin";
		} else {
		die("not authorized");
		setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
		}
	}
?>
