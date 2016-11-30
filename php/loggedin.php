<?php
	// Checks to see if the person landing on the page is logged in.
	if (!isset($_SESSION['userDetails'])) {
		header("Location: index.php");
	}
?>
