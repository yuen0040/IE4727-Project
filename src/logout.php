<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
require 'db.php';

// Destroy PHP session
session_unset();
session_destroy();

// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Redirect to login page
header("Location: login.html");
exit();
