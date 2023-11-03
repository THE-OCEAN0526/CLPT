<?php
session_start();
require 'config.php';

// destroy all session and redirect user to login page

session_destroy();
header('location: ' . DOMAIN . 'Home_page.php');
die();
?>