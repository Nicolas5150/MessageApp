<?php
  if(isset($_SESSION['userDetails'])) {
    $tableName = $_SESSION['userDetails'][3];
    $sql = "SELECT * FROM $tableName";
    // Create the query to send to the database gathering all data from it.
    $result = mysqli_query($connection, $sql) or die(mysql_error());

    // Declare an array that will hold all the contacts (from each row).
    $array = array();
    $i = 0;
    while($row = mysqli_fetch_assoc($result)) {
      $array[$i] = $row;
      $i++;
    }
  }
?>
