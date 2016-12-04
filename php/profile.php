<?php
	session_start();
	require("db_group4.php");
	require("loggedin.php");
  //include("image.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
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

    <h2>Welcome To Your Profile!</h2>
    <div id="avatar">
      <?php
			// Select temp profile gender image.
      if ($_SESSION['userDetails'][7] == "male") {
				echo '<script type="text/javascript">',
	     "addImage('../img/male.jpg');",
	     '</script>';
      }
			else {
				echo '<script type="text/javascript">',
	     "addImage('../img/female.jpg');",
	     '</script>';
			}
      ?>
    </div>

    <!-- Section for uploading a photo for the user
    <form action="#" method="POST" enctype="multipart/form-data" >
      Upload a Profile picture:<br><br>
      <input type="file" name="file"><br><br>
      <input type="submit" name="upload" value="Upload">
    </form>
    -->
    <table style="width:100%">
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Username</th>
        <th>Phone Number</th>
        <th>Phone Location</th>
        <th>Email</th>
      </tr>
      <tr>
        <?php
          echo "<td>".$_SESSION['userDetails'][1]."</td>"; // firstname
          echo "<td>".$_SESSION['userDetails'][2]."</td>"; // lastname
          echo "<td>".$_SESSION['userDetails'][3]."</td>"; // username
          echo "<td>".$_SESSION['userDetails'][4]."</td>"; // phone
          echo "<td>".$_SESSION['userDetails'][5]."</td>"; // phonelocation
          echo "<td>".$_SESSION['userDetails'][6]."</td>"; // email
        ?>
      </tr>
    </table>
		<?php include("footer.php"); ?>
  </body>
</html>
