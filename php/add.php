<?php
	session_start();
	include("db_group4.php");
	include("loggedin.php");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Add Recepients</title>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<link rel="stylesheet" type="text/css" href="../css/basic_style.css" media="screen"/>
		<script src="../js/navbar.js" type="text/javascript"></script>
	</head>

	<body>
		<ul class="topnav" id="myTopnav">
      <li><a href="profile.php">Home</a></li>
      <li><a href="create.php">Create Message</a></li>
      <li><a href="add.php">Add Recipients</a></li>
      <li><a href="contacts.php">Contact List</a></li>
			<li style="float: right"><a class="active" href="logout.php">Log Out</a></li>
      <li class="icon">
        <a href="#" style="font-size:15px;" onclick="myFunction()">☰</a>
      </li>
    </ul>
		<h2>Add a phone number to your contact list!</h2>
		<div id="container">
			<div id="phone">
				<form id="phoneform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				  First Name:<br>
				  <input type="text" name="firstname"><br/><br/>
					Last Name:<br>
				  <input type="text" name="lastname"><br/><br/>
					Phone Number: (EX. 55555555555)<br>
				  <input type="text" name="phone" maxlength="10"><br/><br/>
					Carrier:<br>
					<select name="carrier" id="carrier">
					  <option value="txt.att.net">AT&amp;T</option>
						<option value="sms.mycricket.com">Cricket</option>
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
		<?php include("footer.php"); ?>
	</body>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  $firstname = $_POST['firstname'];
	  $lastname = $_POST['lastname'];
	  $phone = $_POST['phone'];
		$phoneNumberErr = NULL;
	  $carrier = $_POST['carrier'];
	  $email = "N/A";
	  if (isset($_POST['email'])) {
	    $email = $_POST['email'];
	  }
		// Check to see the phone number section is actually filled out.
		if (!empty($_POST["phone"])) {
			// Check to see the phone number section filled out correctly.
	    $phone = preg_replace('/[^0-9.]+/', '', $_POST["phone"]);
	    if (strlen($phone) != 10) {
				$phoneNumberErr = "Phone number must be only 10 numbers";
				echo "<script type='text/javascript'>alert('$phoneNumberErr');</script>";
	    }

			// Passed phone number check, make sure number is not already in table.
			else
			{
				// get username of the loggedin individual into a var to create table from
				$tableName = $_SESSION['userDetails'][3];
				$sql = "SELECT * FROM $tableName WHERE phone='".$phone."' LIMIT 1";	//checks the server for a duplicate of the user defined username.
				$result = mysqli_query($connection, $sql);

				// Username already exists.
				if (mysqli_num_rows($result) == 1) {
					$message = $phone. " exists!";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}

				// Number does does not exist in table yet.
		    else {
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
			}
		}
		// No phone number entered.
		else {
			$phoneNumberErr = "Please enter phone number!";
			echo "<script type='text/javascript'>alert('$phoneNumberErr');</script>";
		}
	}
?>
