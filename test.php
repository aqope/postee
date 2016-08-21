 <?php
$item = "Zak's and Derick's Laptop";
$escaped_item = mysql_escape_string($item);
printf ("Escaped string: %s\n", $escaped_item);
?> 