<?php
session_start();
include("db_group4.php");
if (isset($_SESSION['loggedin'])) {
  header("Refresh: 3; url=profile.php");
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen"/>
		<title>Login</title>
	</head>

	<body>
    <center>
    	<div class="forms">
    		<h1> Log In to your account here!</h1>
    			<form action="" method="POST">
    					<input name="username" type="text" placeholder="Username" class= "box" value=""><br>
    					<input name="password" type="password" placeholder="Password" class= "box" value=""><br>
    					<input type="submit" name="submit" class="submit" value="Login">
    			</form><br>

          <form action="register.php">
            <input type="submit" value="No Account?" />
          </form>
        </div>
    </center>
  </body>
</html>

<?php
// Check for a already logged in user.
if (isset($_SESSION['loggedin'])) {
  header("Refresh: 3; url=profile.php");
}
	if ((isset($_POST['submit'])) && (!isset($_SESSION['loggedin']))) {		//Checks if NOT logged in AND submit button has been pressed...
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = sha1($_POST['password']);			//Encrypts the user defined password before it's sent to the database.
		$sql = "SELECT * FROM user WHERE username= '" .$username. "' AND password= '" .$password. "' LIMIT 1"; //Sets up query for login credentials.
		$result = mysqli_query($connection, $sql);		//runs the query.

  	if (mysqli_num_rows($result) == 1) {				//if the query returns ONE matching entry...
  		$row = mysqli_fetch_row($result);
  		$_SESSION['loggedin'] = true;				//sets a session variable that defines the user's login status as true.
  		$_SESSION['logged_in_user'] = $username;
  		$_SESSION['firstname'] = $row[3];

  /*  Figure out which method will be better for assignment
      $_SESSION['userDetails'] = array();
      $_SESSION['userDetails'][] = $username;
      $_SESSION['userDetails'][] = $firstname;
      $_SESSION['userDetails'][] = $lastname;
      $_SESSION['userDetails'][] = $phone;
      $_SESSION['userDetails'][] = $email;
      $_SESSION['userDetails'][] = $gender;
  */

		echo "Hi, " . $_SESSION['logged_in_user'] . " you are logged in. You will be redirected to your Profile Page.";
		}
    else {
			echo "<h5 class='loginerr'>Invalid Credentials. Please try again.</h5>";		//If no entry matches the query, a message displays.
		}
  }
?>
