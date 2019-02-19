<?php

	$con = mysqli_connect("localhost", "root", "", "social");

	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . (mysqli_connect_errno());
	}

	//Declaring variables to prevent errors
	$fname = ""; //First name
	$lname = ""; //Last name
	$em = ""; //Email
	$em2 = ""; //Email 2
	$password = ""; //Password
	$password2 = ""; //Password 2
	$date = ""; //Sign up date
	$error_array = "";

	if(isset($_POST['register_button'])) {

	//Registration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']); //Remove HTML tags
	$fname = str_replace(' ', '', $fname); //Remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter

	//Last name
	$lname = strip_tags($_POST['reg_lname']); //Remove HTML tags
	$lname = str_replace(' ', '', $lname); //Remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter

	//Email
	$em = strip_tags($_POST['reg_email']); //Remove HTML tags
	$em = str_replace(' ', '', $em); //Remove spaces
	$em = ucfirst(strtolower($em)); //Uppercase first letter

	//Email 2
	$em2 = strip_tags($_POST['reg_email2']); //Remove HTML tags
	$em2 = str_replace(' ', '', $em2); //Remove spaces
	$em2 = ucfirst(strtolower($em2)); //Uppercase first letter

	//Password
	$password = strip_tags($_POST['reg_password']); //Remove HTML tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove HTML tags

	$date = date("Y-m-d"); //Current date.
}

?>

<html>
<head>
	<title></title>
</head>
<body>

	<form action="register.php" method="POST">
		<input type="text" name="reg_fname" placeholder="First Name" required>
		<br>
		<input type="text" name="reg_lname" placeholder="Last Name" required>
		<br>
		<input type="text" name="reg_email" placeholder="Email" required>
		<br>
		<input type="text" name="reg_email2" placeholder="Confirm Email" required>
		<br>
		<input type="password" name="reg_password" placeholder="Password" required>
		<br>
		<input type="password" name="reg_password2" placeholder="Confirm Password" required>
		<br>
		<input type="submit" name="register_button" value="Register">

	</form>

</body>
</html>