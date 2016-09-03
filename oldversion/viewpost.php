<?php
include 'class/database.php';
$post = getPostById($_GET['id']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple Blog</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">

</head>
<body>
<?php
echo "<div class='post-full'>";
echo "<h1>" . $post->getTitle() . "</h1>";
echo "<h3>" . $post->getDate() . "</h3>";
// echo "<p>"  . $post->getContent() . "</p>";
$content = $post->getContent();
$pos = strpos($post->getContent(), "\r\n");
$pre = 0;
while(!($pre > $pos)) {
	echo "<p>" . substr($content,$pre, $pos-$pre) . "</p>";
	$pre = $pos;
	$pos = strpos($post->getContent(), "\n", $pos + 1);
}
echo "<p> " . substr($content, $pre) . "</p>";
echo "<hr>";
echo "</div>";
echo "<a href='../index.php'><button>Go Back</button></a>";
?>
</body>
</html>