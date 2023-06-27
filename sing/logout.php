<?php
session_start();

// Clear session data
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: ../index.php");
exit();
?>
