<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    // Check for a session ID in cookies
    if (isset($_COOKIE['session_id'])) {
        $session_id = $_COOKIE['session_id'];
        // Query database for session validity
        $stmt = $conn->prepare("SELECT user_id, expires_at, status FROM sessions WHERE session_id = ? AND status = 'Active'");
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        $session = $stmt->get_result()->fetch_assoc();

        if ($session && strtotime($session['expires_at']) > time()) {
            // Set session if valid
            $_SESSION['user_id'] = $session['user_id'];
        } else {
            // Expire session if not valid
            setcookie('session_id', '', time() - 3600, "/"); // Delete cookie
            header("Location: login.php");
            exit();
        }
    } else {
        // Redirect to login if no session
        header("Location: login.php");
        exit();
    }
}

// User is logged in, redirect to cart.html
header("Location: orderHistory.html");
