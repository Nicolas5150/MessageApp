<?php
  session_start();
  include("db_group4.php");
  if (isset($_SESSION['userDetails'])) {
    header("Refresh: 3; url=profile.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/indexStyle.css" media="screen"/>
		<title>Login</title>
	</head>

	<body>
		<ul>
			<li><a href="profile.php">Home</a></li>
			<li><a href="create.php">Create Message</a></li>
			<li><a href="add.php">Add Recepients</a></li>
			<li><a href="contacts.php">Contact List</a></li>
		</ul>
		<h2>Welcome to the Message App, please log in to get started!</h2>
    <div class="forms">
    	<h1> Log In to your account here!</h1>
    		<form action="#" method="POST">
    				<input name="username" type="text" placeholder="Username" class= "box" value=""><br>
    				<input name="password" type="password" placeholder="Password" class= "box" value=""><br>
    				<input type="submit" name="submit" class="submit" value="Login">
    		</form><br>

        <form action="register.php">
          <input type="submit" value="No Account?" />
        </form>
      </div>
  </body>
</html>

<?php
	if ((isset($_POST['submit'])) && (!isset($_SESSION['loggedin']))) {		//Checks if NOT logged in AND submit button has been pressed...
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = sha1($_POST['password']);			//Encrypts the user defined password before it's sent to the database.
		$sql = "SELECT * FROM user WHERE username= '" .$username. "' AND password= '" .$password. "' LIMIT 1"; //Sets up query for login credentials.
		$result = mysqli_query($connection, $sql);		//runs the query.

  	if (mysqli_num_rows($result) == 1) {				//if the query returns ONE matching entry...
  		$row = mysqli_fetch_row($result);

			// Create session based on data returned from the database
      $_SESSION['userDetails'] = array();
			$_SESSION['userDetails'][0] = true;
      $_SESSION['userDetails'][1] = $row[1]; // firstname
      $_SESSION['userDetails'][2] = $row[2]; // lastname
			$_SESSION['userDetails'][3] = $row[3]; // username
      $_SESSION['userDetails'][4] = $row[5]; // phone
			$_SESSION['userDetails'][5] = $row[6]; // phonelocation
      $_SESSION['userDetails'][6] = $row[7]; // email
      $_SESSION['userDetails'][7] = $row[8]; // gender

  		echo "Hi, " . $_SESSION['userDetails'][3] . " you are logged in. You will be redirected to your Profile Page.";
      header("Refresh: 3; url=profile.php");
		}
    else {
			echo "<h5 class='loginerr'>Invalid Credentials. Please try again.</h5>";		//If no entry matches the query, a message displays.
		}
  }
?>
