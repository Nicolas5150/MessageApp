<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Project 4</title>
    <meta charset="utf-8">
    <link href="../css/registerStylesheet.css" rel="stylesheet" type="text/css">
	</head>

	<body>
    <?php include("db_group4.php"); ?>
  <center>
		<div class="forms">
			<h1>Create your account here!</h1>

					<form method="POST" action="">
					<p><span class="error">* required field</span></p><br><br>

							<input name="firstname" type="text" placeholder="First Name" class="box" value="">
								<span class="error">* </span><br><br>

							<input name="lastname" type="text" placeholder="Last Name" class="box" value="">
								<span class="error">* </span><br><br>

                <input name="username" type="text" placeholder="Username" class="box" value="">
  								<span class="error">* </span><br><br>

  							<input name="password" type="password" placeholder="Password" class="box" value="">
  								<span class="error">* </span><br><br>

							<input name="phone" type="text" placeholder="Phone Number" size="10" maxlength="10" class="box" value="">
							<span class="error">* </span><br>
								<input type = "radio" name ="phonelocation" value= "home"/>Home<br />
								<input type = "radio" name ="phonelocation" value= "mobile"/>Mobile<br /><br>

							<input name="email" type="text" placeholder="Email" class="box" value="">
								<span class="error">* </span><br><br>

							<input type = "radio" name ="gender" value= "male"/>Male<br />
							<input type = "radio" name ="gender" value= "female"/>Female<br /><br>

							<input type="submit" name="register" class="submit" value="Register"><br><br>
					</form>

<?php
if (isset($_POST['register'])) //if create account submit button is pressed.
{
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
  $username = $_POST['username'];
	$password = sha1($_POST['password']);	//encripts user defined password variable.
	$phone = $_POST['phone'];
	$phonelocation = $_POST['phonelocation'];
	$email = $_POST['email'];
	$gender = $_POST['gender'];

	if (empty($username)) {
    print '<h5 class= "err">Username is required.</h5>';
  }
  else {
    $validusername = "";
  }
  if	(empty($password)) {
	  print '<h5 class= "err">Enter a valid password, letters and numbers only.</h5>';
	}
  else {
    $validpassword = "";
    }
	if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
  }
	if (empty($firstname)) {
    print '<h5 class= "err">Enter your first name.</h5>';
  }
  else {
    $validfirstname = "";
    }
	if (empty($lastname)) {
    print '<h5 class= "err">Enter your last name.</h5>';
  }
  else {
      $validlastname = "";
  }

  $phone = preg_replace("/[\)\(\s-.]/", '', $phone);
	if (!preg_match("/^[0-9]{10}/", $phone))  {
	  print '<h5 class= "err">Phone must be 10 numbers</h5>';
  }
  else {
    $validphone = "";
  }

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  print '<h5 class= "err">Invalid email format.</h5>';
	}
  else {
	  $validemail = "";
	}


  if (isset($validusername) && isset($validpassword) && isset($validfirstname) && isset($validlastname) && isset($validphone) && isset($validemail))
  {
	  $sql = "SELECT * FROM user WHERE username='".$username."' LIMIT 1";	//checks the server for a duplicate of the user defined username.
	  $result = mysqli_query($connection, $sql);

	  if (mysqli_num_rows($result) == 1) {		//if username already exists on the server...
		echo "<h5 class='loginerr'>Username taken. Choose another Username.</h5>";
	  }

    else // the username does not exist
    {
      /* Leave for testing
      echo "username ".$username."<br>";
      echo "password ".$password."<br>";
      echo "firstname ".$firstname."<br>";
      echo "lasstname ".$lastname."<br>";
      echo "phone ".$phone."<br>";
      echo "phoneloc ".$phonelocation."<br>";
      echo "email ".$email."<br>";
      echo "gender ".$gender."<br>";
      */

		  $sql = "INSERT INTO user (firstname, lastname, username, password, phone, phonelocation, email, gender)
      VALUES ('$firstname', '$lastname', '$username', '$password', '$phone', '$phonelocation', '$email','$gender')";			//creates a new entry in account table containing the user defined variable inputs...
		  mysqli_query($connection, $sql);
      // Create an array that stores the user details as a session.
      $_SESSION['userDetails'] = array();
      $_SESSION['userDetails'][] = "true";
      $_SESSION['userDetails'][] = $username;
      $_SESSION['userDetails'][] = $firstname;
      $_SESSION['userDetails'][] = $lastname;
      $_SESSION['userDetails'][] = $phone;
      $_SESSION['userDetails'][] = $email;
      $_SESSION['userDetails'][] = $gender;

	    echo "<h5 class='loginerr'>Your account is created! Directing to the Login form.</h5>";
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
        echo"it worked!";
        header("Refresh: 3; url=profile.php");		//redirects to the profile page.
      }
      else {
        echo"nope";
      }
		}
  }
}
?>
  </center>
		</div>
	</body>
</html>
