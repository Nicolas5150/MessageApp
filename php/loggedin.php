<?php
	// Checks to see if the person landing on the page is logged in.
	if (!isset($_SESSION['loggedin'])) {
		header("Refresh: 0, url=login.php");
	}
?>
