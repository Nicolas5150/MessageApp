<?php
	session_start();
	require("db_group4.php");
	require("loggedin.php");
	require("get_contacts.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Create Message</title>
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
			<li style="float: right"><a class="active" href="logout.php">Log Out</a></li>
      <li class="icon">
        <a href="#" style="font-size:15px;" onclick="myFunction()">☰</a>
      </li>
    </ul>

		<h2>Create your message!</h2>
		<h3>Message will be sent to all recipients</h3>

		<div id="Message">
				<form id="messageform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				  Full Name:<br>
				  <input type="text" name="name"><br>
				  <br>
				  Message:<br>
				  <textarea rows="4" cols="50" name="comment" placeholder="Enter message here"></textarea>
				  <br>
				  <input type="submit" name="submit" value="submit">
				</form>
			</div>
			<?php include("footer.php"); ?>
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
