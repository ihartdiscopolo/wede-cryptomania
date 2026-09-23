<?php

require_once('includes/session.php');
require_once("includes/headerFunctions.php");

// unsets the user form the session variable (logs the user out) and redirects the user to the homepage
unset($_SESSION['user']);
// header("Location: index.php");
echo "<script>
    alert('Successfully logged out!');
    window.location.href= 'index.php'; </script>";