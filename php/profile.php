<?php
	session_start();
	require("db_group4.php");
	require("loggedin.php");
  //include("image.php");
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
    <h2>Welcome To Your Profile!</h2>
    <div id="avatar">
      <p>Avatar Picture based on gender</p>
      <?php
      if ($_SESSION['userDetails'][7] == "male") {
        // Code to generate avatar goes here
        // May be swapped later for actual profile picture
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
  </body>
</html>
