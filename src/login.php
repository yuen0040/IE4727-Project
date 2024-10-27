<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
require 'db.php';

// Capture form input
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Debugging: Print received email and password
echo "Received email: $email<br>";
echo "Received password: " . (!empty($password) ? '****' : 'empty') . "<br>";

// Check for existing session (if user is already logged in)
if (isset($_COOKIE['session_id'])) {
    $session_id = $_COOKIE['session_id'];
    // Verify session in the database
    $stmt = $conn->prepare("SELECT user_id, expires_at, status FROM sessions WHERE session_id = ? AND status = 'Active'");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // Debugging: Check session result
    echo "Session result: ";
    var_dump($result);

    if ($result && strtotime($result['expires_at']) > time()) {
        // If the session is still valid, retrieve the user info and redirect to homepage
        $_SESSION['user_id'] = $result['user_id'];
        header("Location: index.php");
        exit();
    }
}

// If no valid session, proceed with login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $email && $password) {
    // Check if user exists and retrieve hashed password
    $stmt = $conn->prepare("SELECT user_id, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    // Debugging: Check user result
    echo "User result: ";
    var_dump($user);

    if ($user && password_verify($password, $user['password_hash'])) {
        // User authenticated, create session
        $user_id = $user['user_id'];
        $session_id = bin2hex(random_bytes(16)); // Generate session ID
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 year')); // Set expiry date

        // Insert session into database
        $stmt = $conn->prepare("INSERT INTO sessions (session_id, user_id, created_at, expires_at, status) VALUES (?, ?, NOW(), ?, 'Active')");
        $stmt->bind_param("sis", $session_id, $user_id, $expires_at);
        $stmt->execute();

        // Debugging: Check if session was created
        if ($stmt->affected_rows > 0) {
            // Set session in cookies
            setcookie('session_id', $session_id, time() + (365 * 24 * 60 * 60), "/"); // 1 year expiration

            // Set user session
            $_SESSION['user_id'] = $user_id;

            header("Location: index.php");
            exit();
        } else {
            echo "Failed to create session.<br>";
        }
    } else {
        // Invalid login
        echo "Invalid email or password.<br>";
    }
}
