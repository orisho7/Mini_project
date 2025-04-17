<?php
session_start();
session_unset();
session_destroy();

// Also prevent caching here
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to login
header("Location: index.php");
exit();
?>