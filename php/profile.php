<?php session_start();
if ($_SESSION['userDetails'][0] != "true"){
	header("Refresh: 3; url=register.php");		//redirects to the register / login page.
}
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

			<div id="phone">
				<h2>Add a phone number to your contact list!</h2>
				<form>
				  First Name:<br>
				  <input type="text" name="firstname"><br/><br/>
					Last Name:<br>
				  <input type="text" name="lastname"><br/><br/>
				  Phone Number:<br>
				  <input type="text" name="phone"><br/><br/>
					Carrier:<br>
					<select id="carrier">
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
				  <input type="submit" name="submit">
				</form>
			</div>

	</body>

</html>
