<?php
	session_start();
	require("loggedin.php");
	include("db_group4.php");
	//include("image.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Profile Page</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/profileStylesheet.css" type="text/css" />
	</head>

	<body style="background-image: url('gradient.jpg'); background-repeat: no-repeat; background-size:100% 100%;">

		<div id="container">
			<h2>Welcome To Your Profile!</h2>

			<div id="avatar">
				<p>Avatar Picture based on gender</p>
			</div>

			<form action="" method="POST" enctype="multipart/form-data" >
				Upload a Profile picture:<br><br>
				<input type="file" name="file"><br><br>
				<input type="submit" name="upload" value="Upload">
			</form>

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
		$tableName = $_SESSION['userDetails'][0];
		//$tableName = $_SESSION['logged_in_user']; // if user logs in rather thatn signs up

		// Find table that was created on register that correlates to the username loggedin
	  $sql = "INSERT INTO $tableName (id, firstname, lastname, email, phone, carrier)
		VALUES ('NULL', '$firstname', '$lastname', '$email', '$phone', '$carrier')";
	  $insert = mysqli_query($connection, $sql);
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
