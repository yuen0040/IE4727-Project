<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require 'db.php';

// Validate and sanitize input
$first_name = filter_input(INPUT_POST, 'first-name', FILTER_UNSAFE_RAW);
$last_name = filter_input(INPUT_POST, 'last-name', FILTER_UNSAFE_RAW);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$phone_number = filter_input(INPUT_POST, 'phone', FILTER_UNSAFE_RAW);

$response = ['success' => false, 'error' => 'An error occurred during registration.'];

// Additional fields (you may want to add these to the form or hardcode them as needed)
$address = NULL; // Adjust to retrieve from form or static value
$postal_code = NULL; // Adjust to retrieve from form or static value
$gender = NULL; // Adjust to retrieve from form or static value

// Check if the email already exists
$email_check_stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
$email_check_stmt->bind_param("s", $email);
$email_check_stmt->execute();
$email_check_stmt->store_result();

if ($email_check_stmt->num_rows > 0) {
    $response['error'] = "Email is already registered.";
} else {
    // Prepare the SQL statement to insert a new user
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password_hash, phone_number, address, postal_code, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $password, $phone_number, $address, $postal_code, $gender);

    // Execute the statement
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['error'] = "Registration failed. Please try again.";
    }

    // Close the statement
    $stmt->close();
}

// Close the email check statement and connection
$email_check_stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
