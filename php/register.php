<?php
	session_start();
	include("db_group4.php");
	if (isset($_SESSION['userDetails'])) {
    header("Refresh: 3; url=profile.php");
  }
	$usernameErr = $passwordErr = $firstnameErr =  $lastnameErr =  $phoneErr =  $emailErr= "";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Register</title>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<link rel="stylesheet" type="text/css" href="../css/basic_style.css" media="screen"/>
		<script src="../js/navbar.js" type="text/javascript"></script>
	</head>

	<body>
		<ul class="topnav" id="myTopnav">
      <li><a href="profile.php">Home</a></li>
      <li><a href="create.php">Create Message</a></li>
      <li><a href="add.php">Add Recepients</a></li>
      <li><a href="contacts.php">Contact List</a></li>
      <li class="icon">
        <a href="#" style="font-size:15px;" onclick="myFunction()">☰</a>
      </li>
    </ul>

<?php
	if(isset($_POST['register'])) {		//if create account submit button is pressed.
		$username = $_POST['username'];
		$password = ($_POST['password']);	//encripts user defined password variable.
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$phonelocation = $_POST['phonelocation'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];


	  if (empty($username)) {
      $usernameErr = "Username is required";
		}
    else {
      $validusername = "";
    }
    if (empty($password)) {
		  $passwordErr = "Enter a valid password, letters and numbers only.";
		}
    else {
      $validpassword = "";
    }
		if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
    }
	  if (empty($firstname)) {
      $firstnameErr = "Enter your first name.";
    }
    else {
      $validfirstname = "";
    }
	  if (empty($lastname)) {
     	$lastnameErr = "Enter your last name";
   }
   else {
    	$validlastname = "";
    }

  	$phone = preg_replace("/[\)\(\s-.]/", '', $phone);
	  if (!preg_match("/^[0-9]{10}/", $phone)) {
		  $phoneErr = "Phone must be 10 numbers";
    }
    else {
      $validphone = "";
    }
	  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "Invalid email format";
		}
    else {
		  $validemail = "";
		}

 if (isset($validusername) && isset($validpassword) && isset($validfirstname) && isset($validlastname) && isset($validphone) && isset($validemail)) {
		$sql = "SELECT * FROM user WHERE username='".$username."' LIMIT 1";	//checks the server for a duplicate of the user defined username.
		$result = mysqli_query($connection, $sql);

		if (mysqli_num_rows($result) == 1) {		//if username already exists on the server...
			echo "<h5 class='loginerr'>Username taken. Choose another Username.</h5>";
		}
    else {								//if the username does not exist
			$password = sha1($_POST['password']);	// encrypt password
			$sql = "INSERT INTO user (username,password,firstname,lastname,phone,phonelocation,email,gender) VALUES ('$username','$password','$firstname','$lastname','$phone','$phonelocation','$email','$gender')";			//creates a new entry in account table containing the user defined variable inputs...
			mysqli_query($connection, $sql);
      // Create an array that stores the user details as a session.
      $_SESSION['loggedin'] = true;
      $_SESSION['userDetails'] = array();
			$_SESSION['userDetails'][0] = true;
      $_SESSION['userDetails'][1] = $firstname;
      $_SESSION['userDetails'][2] = $lastname;
      $_SESSION['userDetails'][3] = $username;
      $_SESSION['userDetails'][4] = $phone;
			$_SESSION['userDetails'][5] = $phonelocation;
      $_SESSION['userDetails'][6] = $email;
      $_SESSION['userDetails'][7] = $gender;

      // Create a new table in the database corresponding to the new user created.
      // This will be how the users table can reach its corresponding user table (relation)
      $newTable = " CREATE TABLE $username (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        phone VARCHAR(50),
        carrier VARCHAR(50)
        )";

      $tableResult = mysqli_query($connection, $newTable);
      if ($tableResult === TRUE) {
        header("Refresh: 1; url=profile.php");		//redirects to the profile page.
      }
      else {
				echo "<h2 class='loginerr'>Error in creating user table.</h2>";
      }
		}
	}
}
?>

		<div class="forms">
			<h2>Create your account here!</h2>
			<form method="POST" action="#">
				<span class="error">Required Fields *</span><br>
				<span class="error"><?php echo $usernameErr;?></span><br/>
				<input name="username" type="text" placeholder="Username" class="box" value="">
				<span class="error">*</span><br/>

				<span class="error"><?php echo $passwordErr;?></span><br/>
				<input name="password" type="password" placeholder="Password" class="box" value="">
				<span class="error">*</span><br/>

				<span class="error"><?php echo $firstnameErr;?></span><br/>
				<input name="firstname" type="text" placeholder="First Name" class="box" value="">
				<span class="error">*</span><br/>

				<span class="error"><?php echo $lastnameErr;?></span><br/>
				<input name="lastname" type="text" placeholder="Last Name" class="box" value="">
				<span class="error">*</span><br/>

				<span class="error"><?php echo $emailErr;?></span><br/>
				<input name="email" type="text" placeholder="Email" class="box" value="">
				<span class="error">*</span><br/>

				<span class="error"><?php echo $phoneErr;?></span><br/>
				<input name="phone" type="text" placeholder="Phone Number" maxlength="10" class="box" value="">
				<span class="error">*</span>
					<select name="phonelocation">
						<option value="home">Home</option>
						<option value="mobile">Mobile</option>
					</select> <br/>

				<select name="gender">
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select> <br/>

				<input type="submit" name="register" class="submit" value="Register"><br/>
			</form>

			<form action="index.php">
				<input type="submit" value="Have An Account?" />
			</form>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>
