<?php
session_start();
require 'db.php';

// Check if session ID is in cookies
if (isset($_COOKIE['session_id'])) {
    $session_id = $_COOKIE['session_id'];
    // Mark session as expired
    $stmt = $conn->prepare("UPDATE sessions SET status = 'Expired' WHERE session_id = ?");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();

    // Delete the session cookie
    setcookie('session_id', '', time() - 3600, "/");
}

// Destroy PHP session
session_destroy();

// Redirect to login page
header("Location: login.html");
exit();
?>
