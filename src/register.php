<?php
// Connect to MySQL database
$servername = "localhost"; // Or your server hostname
$username = "root";
$password = "";
$dbname = "solegood";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input
$first_name = filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING);
$last_name = filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$phone_number = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

// Additional fields (you may want to add these to the form or hardcode them as needed)
$address = ""; // Adjust to retrieve from form or static value
$postal_code = ""; // Adjust to retrieve from form or static value
$gender = ""; // Adjust to retrieve from form or static value

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password_hash, phone_number, address, postal_code, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $first_name, $last_name, $email, $password, $phone_number, $address, $postal_code, $gender);

// Execute the statement
if ($stmt->execute()) {
    echo "Account created successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
