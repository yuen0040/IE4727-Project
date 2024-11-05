<?php

session_start();
require 'db.php';
$user_id = $_SESSION['user_id'];

if (isset($_POST['first-name']) && isset($_POST['last-name'])) {
  $first_name = filter_input(INPUT_POST, 'first-name', FILTER_UNSAFE_RAW);
  $last_name = filter_input(INPUT_POST, 'last-name', FILTER_UNSAFE_RAW);
  if (isset($_POST['gender'])) {
    $gender = $_POST['gender'];
    if ($gender === "Male") {
      $gender = 1;
    } else if ($gender === "Female") {
      $gender = 0;
    } else {
      $gender = NULL;
    }
  }

  $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, gender = ? WHERE user_id = ?");
  $stmt->bind_param("ssii", $first_name, $last_name, $gender, $user_id);
  if ($stmt->execute()) {
    $response['success'] = true;
  } else {
    $response['error'] = "Error changing personal details, please try again.";
  }
}

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $email_check_stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
  $email_check_stmt->bind_param("s", $email);
  $email_check_stmt->execute();
  $result = $email_check_stmt->get_result();
  $dupe_email_id = $result->fetch_assoc();

  if ($result->num_rows > 0 && $dupe_email_id['user_id'] !== $user_id) {
    $response['error'] = "Email is already registered.";
  } else {
    $stmt = $conn->prepare("UPDATE users SET email = ?, password_hash = ? WHERE user_id = ?");
    $stmt->bind_param("ssi", $email, $password, $user_id);
    if ($stmt->execute()) {
      $response['success'] = true;
    } else {
      $response['error'] = "Error changing login details, please try again.";
    }
  }
}

if (isset($_POST['address']) && isset($_POST['postal-code']) && isset($_POST['phone'])) {
  $address = filter_input(INPUT_POST, 'address', FILTER_UNSAFE_RAW);
  $postal_code = filter_input(INPUT_POST, 'postal-code', FILTER_UNSAFE_RAW);
  $phone_number = filter_input(INPUT_POST, 'phone', FILTER_UNSAFE_RAW);

  $stmt = $conn->prepare("UPDATE users SET address = ?, postal_code = ?, phone_number = ? WHERE user_id = ?");
  $stmt->bind_param("sisi", $address, $postal_code, $phone_number, $user_id);
  if ($stmt->execute()) {
    $response['success'] = true;
  } else {
    $response['error'] = "Error changing address details, please try again.";
  }
}

header('Content-Type: application/json');
echo json_encode($response);
