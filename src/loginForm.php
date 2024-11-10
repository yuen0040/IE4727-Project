<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require 'db.php';
require 'resolveCarts.php';
session_start();
$session_id = session_id();

// Capture form input
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$response = ['success' => false, 'error' => 'Invalid email or password.'];

// If no valid session, proceed with login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $email && $password) {
    // Check if user exists and retrieve hashed password
    $stmt = $conn->prepare("SELECT user_id, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        // User authenticated
        $user_id = $user['user_id'];
        resolveCarts($conn, $user_id);
        // Set user session
        $_SESSION['user_id'] = $user_id;
        $response = ['success' => true];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
