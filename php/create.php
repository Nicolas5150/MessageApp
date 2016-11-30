<?php
	session_start();
	require("db_group4.php");
	require("loggedin.php");
	require("get_contacts.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<link href="../css/createStyle.css" rel="stylesheet" type="text/css">
		<title>Create Message</title>
	</head>
	<body>
		<ul>
			<li><a href="profile.php">Home</a></li>
			<li><a href="create.php">Create Message</a></li>
			<li><a href="add.php">Add Recepients</a></li>
			<li><a href="contacts.php">Contact List</a></li>
		  <li style="float: right"><a class="active" href="logout.php">Log Out</a></li>
		</ul>
		<h2 align="center">Create your message!</h2>

		<div id="Message">
				<form id="messageform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				  Full Name:<br>
				  <input type="text" name="name"><br>
				  <br>
				  Message:<br>
				  <textarea rows="4" cols="50" name="comment">Enter Message Here...</textarea>

				  <br>
				  <input type="submit" name="submit" value="submit">
				</form>
			</div>
	</body>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Send off the text message
		 $name = htmlspecialchars($_POST['name']);
		 $comment = htmlspecialchars($_POST['comment']);
		 $contactList = count($array);
		 for($i=0; $i<$contactList; $i++) {
			 mail($array[$i]['phone'] ."@". $array[$i]['carrier'], $name, $comment);
			}
			echo "<script type='text/javascript'>alert('Contacts have been texted!');</script>";
		}
?>
