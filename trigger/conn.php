<?php
	$servername = "127.0.0.1";
$username = "homestead";
$password = "secret";
$database = "aux";

$conn = mysqli_connect($servername,$username,$password,$database);
if (!$conn) {

	die ("Connection failed:".mysqli_error($conn));
}
  ?>
  test test test
