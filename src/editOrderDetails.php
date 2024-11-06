<?php

session_start();
require 'db.php';

$first_name = filter_input(INPUT_POST, 'first-name', FILTER_UNSAFE_RAW);
$last_name = filter_input(INPUT_POST, 'last-name', FILTER_UNSAFE_RAW);
$address = filter_input(INPUT_POST, 'address', FILTER_UNSAFE_RAW);
$postal_code = filter_input(INPUT_POST, 'postal-code', FILTER_UNSAFE_RAW);
$phone_number = filter_input(INPUT_POST, 'phone', FILTER_UNSAFE_RAW);
$order_id = filter_input(INPUT_POST, 'order-id', FILTER_UNSAFE_RAW);

$stmt = $conn->prepare("UPDATE orders SET first_name = ?, last_name = ?, shipping_address = ?, phone_number = ?, postal_code = ? WHERE order_id = ?");
$stmt->bind_param("ssssii", $first_name, $last_name, $address, $phone_number, $postal_code, $order_id);
if ($stmt->execute()) {
  $response['success'] = true;
} else {
  $response['error'] = "Error updating order details, please try again.";
}


header('Content-Type: application/json');
echo json_encode($response);
