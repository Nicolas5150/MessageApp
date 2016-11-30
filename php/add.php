<?php
	session_start();
	include("db_group4.php");
	include("loggedin.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add Contact</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/addStyle.css" type="text/css" />
	</head>

	<body>
		<ul>
			<li><a href="profile.php">Home</a></li>
			<li><a href="create.php">Create Message</a></li>
			<li><a href="add.php">Add Recepients</a></li>
			<li><a href="contacts.php">Contact List</a></li>
			<li style="float: right"><a class="active" href="logout.php">Log Out</a></li>
		</ul>

		<div id="container">
			<div id="phone">
				<h2>Add a phone number to your contact list!</h2>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				  First Name:<br>
				  <input type="text" name="firstname"><br/><br/>
					Last Name:<br>
				  <input type="text" name="lastname"><br/><br/>
				  Phone Number:<br>
				  <input type="text" name="phone"><br/><br/>
					Carrier:<br>
					<select name="carrier" id="carrier">
					  <option value="txt.att.net">AT&amp;T</option>
						<option value="mymetropcs.com">Metro PCS</option>
					  <option value="messaging.nextel.com">Nextel</option>
						<option value="messaging.sprintpcs.com">Sprint</option>
					  <option value="tmomail.net">T-mobile</option>
						<option value="vtext.com">Verizon</option>
						<option value="vmobl.com">Virgin Mobile</option>
					</select> <br><br>
					Email (optional):<br>
				  <input type="text" name="email"><br/><br/>
				  Add to Contacts<br>
				  <input type="submit" name="submit" value="Submit">
				</form>
			</div>
		</div>
	</body>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $firstname = $_POST['firstname'];
	  $lastname = $_POST['lastname'];
	  $phone = $_POST['phone'];
	  $carrier = $_POST['carrier'];
	  $email = "N/A";
	  if (isset($_POST['email'])) {
	    $email = $_POST['email'];
	  }
		// get username of the loggedin individual into a var to create table from
		$tableName = $_SESSION['userDetails'][3];

		// Find table that was created on register that correlates to the username loggedin
	  $sql = "INSERT INTO $tableName (id, firstname, lastname, email, phone, carrier)
		VALUES ('NULL', '$firstname', '$lastname', '$email', '$phone', '$carrier')";
	  $insert = mysqli_query($connection, $sql);
		// Provide the user with an alert if successful
	  if ($insert == true) {
			$message = "Added " .$phone;
			echo "<script type='text/javascript'>alert('$message');</script>";
	  }
	  else {
			$message = "Error - Did not add " .$phone;
			echo "<script type='text/javascript'>alert('$message');</script>";
	  }
	}
?>
