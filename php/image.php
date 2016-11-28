<?php
	if(isset($_POST['upload'])){
		move_uploaded_file($_FILES['file']['tmp_name'],"pictures/".$_FILES['file']['name']);

		$q = "UPDATE user SET image = '".$_FILES['file']['name']."' WHERE username = '".$_SESSION['username']."'";

	}
?>
<!DOCTYPE html>
<html>
	<head>


	</head>


		<body>
<?php include("db_group4.php"); ?>



<?php

	$q = mysqli_query($connection, "SELECT * FROM user");
	while($row = mysqli_fetch_assoc($q)){
		echo $row['username'];
			if($row['image'] == ""){
				echo "<img width='100' height='100' src='pictures/profile.jpg' alt='Default Profile Picture'>";
			}else{
				echo "<img width='100' height='100' src='pictures/".$row['image']."' alt='Profile Picture'>";
			}
	}
?>








		</body>
 </html>
