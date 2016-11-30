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

    <table style="width:100%">
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
  </body>
</html>
