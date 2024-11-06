<?php

require 'db.php';

$order_id = filter_input(INPUT_POST, 'order-id', FILTER_UNSAFE_RAW);

$stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
$stmt->bind_param("i",  $order_id);
if ($stmt->execute()) {
  $response['success'] = true;
} else {
  $response['error'] = "Error occurred when cancelling order, please try again.";
}


header('Content-Type: application/json');
echo json_encode($response);
