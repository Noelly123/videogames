<?php
$mysqli = new mysqli("localhost","2433752","574sa7","db_2433752");
if ($mysqli -> connect_errno) {
echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
exit();
}
?>