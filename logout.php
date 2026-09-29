<?php
include('config/constants.php');

// Unset customer session variables
unset($_SESSION['customer_id']);
unset($_SESSION['customer_user']);
unset($_SESSION['customer_name']);
unset($_SESSION['customer_email']);

// Redirect to home page
header('location:'.SITEURL.'Project.php');
exit();
?>
