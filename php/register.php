<?php
    session_start();
?>

<!DOCTYPE html>


<html lang="en">
	<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css" media="screen"/>
		<title>Project 4</title>
		
	</head>	
	
	<body>
<?php include("db_group4.php"); ?>
	
<center>
		<div class="forms">
			<h1>Create your account here!</h1>

					<form method="POST" action="">
					<p><span class="error">* required field</span></p><br><br>
							<input name="username" type="text" placeholder="Username" class="box" value="">
								<span class="error">* </span><br>
						
							<input name="password" type="password" placeholder="Password" class="box" value="">
								<span class="error">* </span><br>
							
							<input name="firstname" type="text" placeholder="First Name" class="box" value="">
								<span class="error">* </span><br>
							
							<input name="lastname" type="text" placeholder="Last Name" class="box" value="">
								<span class="error">* </span><br>
							
							<input name="phone" type="text" placeholder="Phone Number" size="10" maxlength="10" class="box" value="">
								<span class="error">* </span><br>
							
							<input name="email" type="text" placeholder="Email" class="box" value="">
								<span class="error">* </span><br>
							
							<input type="submit" name="register" class="submit" value="Register"><br>
				
			
			
					</form>
	
<?php
	if(isset($_POST['register'])){		//if create account submit button is pressed.
		$username = $_POST['username'];
		$password = sha1($_POST['password']);	//encripts user defined password variable.
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		
	    if (empty($username)) {
          print '<h5 class= "err">Username is required.</h5>';
        } else {
          $validusername = "";
        }
    if	(empty($password)) {
		print '<h5 class= "err">Enter a valid password, letters and numbers only.</h5>';
		} else {
          $validpassword = "";
        }
		if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
        } 
	if (empty($firstname)) {
          print '<h5 class= "err">Enter your first name.</h5>';
        } else {
          $validfirstname = "";
        }	
	if (empty($lastname)) {
          print '<h5 class= "err">Enter your first name.</h5>';
        } else {
          $validlastname = "";
        }
	
        	
    $phone = preg_replace("/[\)\(\s-.]/", '', $phone);
	if (!preg_match("/^[0-9]{10}/", $phone))  {
		print '<h5 class= "err">Phone must be 10 numbers</h5>'; 
        }else{
          $validphone = "";
        }
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		print '<h5 class= "err">Invalid email format.</h5>'; 
		}else {
		  $validemail = "";
		}	
    
 if (isset($validusername) && isset($validpassword) && isset($validfirstname) && isset($validlastname) && isset($validphone) && isset($validemail)) {	   
  
		

		$sql = "SELECT * FROM group4 WHERE username='".$username."' LIMIT 1";	//checks the server for a duplicate of the user defined username.
		$result = mysqli_query($connection, $sql);
		
		if (mysqli_num_rows($result) == 1){		//if username already exists on the server...
			echo "<h5 class='loginerr'>Username taken. Choose another Username.</h5>";
			
		
		} else {								//if the username does not exist
			$sql = "INSERT INTO group4 (username,password,firstname,lastname,phone,email) VALUES ('$username','$password','$firstname','$lastname','$phone','$email')";			//creates a new entry in account table containing the user defined variable inputs...
			mysqli_query($connection, $sql);
			//$_SESSION['createdacccount'] = 1;		//sets acount created session variable equal to 1.
			echo "<h5 class='loginerr'>Your account is created! Directing to the Login form.</h5>";
			header("Refresh: 3; url=login.php");		//redirects to the login page.
		}
		
	} 
}
?>
</center>
		</div>
	</body>
</html>