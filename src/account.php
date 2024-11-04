<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    // Redirect to login if no session
    header("Location: login.html");
    exit();
}

// User is logged in, redirect to account.html
header("Location: account.html");
