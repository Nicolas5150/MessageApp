<?php
$username = "je613089";
$password = "Group$";
$database = "je613089";

$connection = mysqli_connect("localhost" , "$username" , "$password", "$database") or die(mysql_error());  //(host,username,password,) Connects to mysql server. Throws error if it cannot connect. 
?>