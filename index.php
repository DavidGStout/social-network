<?php

	$con = mysqli_connect("localhost", "root", "", "social");

	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . (mysqli_connect_errno());
	}

	$query = mysqli_query($con, "INSERT INTO test VALUES('', 'David')");

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>lorem feb 19</h1>
</body>
</html>