<?php

	session_start();
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
	$error_array = array();

	if(isset($_POST['register_button'])) {

	//Registration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']); //Remove HTML tags
	$fname = str_replace(' ', '', $fname); //Remove spaces
	$fname = ucfirst(strtolower($fname)); //Uppercase first letter
	$_SESSION['reg_fname'] = $fname; //Stores first name into session variable

	//Last name
	$lname = strip_tags($_POST['reg_lname']); //Remove HTML tags
	$lname = str_replace(' ', '', $lname); //Remove spaces
	$lname = ucfirst(strtolower($lname)); //Uppercase first letter
	$_SESSION['reg_lname'] = $lname; //Stores last name into session variable

	//Email
	$em = strip_tags($_POST['reg_email']); //Remove HTML tags
	$em = str_replace(' ', '', $em); //Remove spaces
	$em = ucfirst(strtolower($em)); //Uppercase first letter
	$_SESSION['reg_email'] = $em; //Stores email into session variable

	//Email 2
	$em2 = strip_tags($_POST['reg_email2']); //Remove HTML tags
	$em2 = str_replace(' ', '', $em2); //Remove spaces
	$em2 = ucfirst(strtolower($em2)); //Uppercase first letter

	//Password
	$password = strip_tags($_POST['reg_password']); //Remove HTML tags
	$password2 = strip_tags($_POST['reg_password2']); //Remove HTML tags

	$date = date("Y-m-d"); //Current date.

	if($em == $em2) {
	//check if email is in valid format
	if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
		$em = filter_var($em, FILTER_VALIDATE_EMAIL);

		//Check if email already exists
		$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

		//Count number of rows returned
		$num_rows = mysqli_num_rows($e_check);

		if($num_rows > 0) {
			array_push($error_array, "Email already in use<br>");
		}

		}
		}
		else {
			array_push($error_array, "Invalid email format<br>");
		}

		}
		else {
			array_push($error_array, "Emails do not match<br>");
		}

		if(strlen($fname) > 25 || strlen($fname) < 2) {
			array_push($error_array, "Your first name must be between 2 and 25 characters<br>");
		}

		if(strlen($lname) > 25 || strlen($lname) < 2) {
			array_push($error_array, "Your last name must be between 2 and 25 characters<br>");
		}

		if($password != $password2) {
			array_push($error_array, "Your passwords do not match<br>");
		}
		else {
			if(preg_match('/[^A-Za-z0-9]/', $password)) {
				array_push($error_array, "Your password can only contain letters or numbers<br>");
			}

			if(strlen($password > 30 || strlen($password) < 5)) {
				array_push($error_array, "Your password must be between 5 and 30 characters<br>");
			}
}



?>

<html>
<head>
	<title></title>
</head>
<body>

	<form action="register.php" method="POST">

		<!–– First name ––>
		<input type="text" name="reg_fname" placeholder="First Name" value="<?php 
		if(isset($_SESSION['reg_fname'])) {
			echo $_SESSION['reg_fname'];
		}


			?>" required>

		<br>

		<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>


		<!–– Last name ––>
		<input type="text" name="reg_lname" placeholder="Last Name" value="<?php 

		if(isset($_SESSION['reg_lname'])) {
			echo $_SESSION['reg_lname'];
		}
			?>" required>
		<br>

		<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>


		<!–– Email ––>
		<input type="text" name="reg_email" placeholder="Email" value="<?php 

		if(isset($_SESSION['reg_email'])) {
			echo $_SESSION['reg_email'];
		}


			?>" required>
		<br>

		<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
		else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
		else if(in_array("Emails do not match<br>", $error_array)) echo "Emails do not match<br>"; ?>


		<!–– Email2 ––>
		<input type="text" name="reg_email2" placeholder="Confirm Email" value="<?php 

		if(isset($_SESSION['reg_email2'])) {
			echo $_SESSION['reg_email2'];
		}


			?>" required>
		<br>

		<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; ?>

		<input type="password" name="reg_password" placeholder="Password" required>
		<br>
		<input type="password" name="reg_password2" placeholder="Confirm Password" required>
		<br>

		<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
		else if(in_array("Your password can only contain letters or numbers<br>", $error_array)) echo "Your password can only contain letters or numbers<br>";
		else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>
		<input type="submit" name="register_button" value="Register">

	</form>

</body>
</html>