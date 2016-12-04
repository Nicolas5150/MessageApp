<?php
	session_start();
	require("db_group4.php");
	require("loggedin.php");
	require("get_contacts.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contact List</title>
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

    <h2>Your Contacts</h2>
		<table>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Phone</th>
        <th>Carrier</th>
      </tr>
        <?php
          // Create a table with all contacts in the database.
          $contactList = count($array);
          for($i=0; $i<$contactList; $i++) {
            echo "<tr>";
   			    echo "<td>".$array[$i]['firstname']."</td>";
            echo "<td>".$array[$i]['lastname']."</td>";
            echo "<td>".$array[$i]['phone']."</td>";
            echo "<td>".$array[$i]['carrier']."</td>";
            echo "</tr>";
   			  }
        ?>
    </table>
		<?php include("footer.php"); ?>
  </body>
</html>
