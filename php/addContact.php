<?php
if(isset($_POST['register']))
{
  include("db_group4.php");
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $phone = $_POST['phone'];
  $carrier = $_POST['carrier'];
  $email = "N/A"
  if (isset($_POST['email'])) {
    $email = $_POST['email'];
  }
  $sql = "INSERT INTO user (firstname, lastname, email, phone, carrier)
          VALUES ('$firstname', '$lastname', '$email' '$phone', '$carrier')";
  $insert = mysqli_query($connection, $sql);
  if ($insert == true)
  {
    echo "passed";
  }
  else{
    echo "fail";
  }

}
?>
