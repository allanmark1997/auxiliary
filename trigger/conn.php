<?php
	$servername = "127.0.0.1";
$username = "homestead";
$password = "secret";
$database = "aux";

$conn = mysqli_connect($servername,$username,$password,$database);
if (!$conn) {

	die ("Connection failed:".mysqli_error($conn));
}
<<<<<<< HEAD
  ?>
=======
  ?>
  test test test
>>>>>>> 9de65350834c8215ddd20d52461bf9bdd4e2bc10
