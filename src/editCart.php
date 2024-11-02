<?php

require 'db.php';

$cart_id = $_POST['cart_id'];
$size_id = $_POST['size_id'];
$quantity = $_POST['quantity'];

if ((int)$quantity > 0) {
  $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cart_id = ? AND size_id = ?");
  $stmt->bind_param("iii", $quantity, $cart_id, $size_id);
  if ($stmt->execute()) {
    $response["success"] = true;
  } else {
    $respnse["error"] = "Could not update quantity";
  }
} else {
  $stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_id = ? AND size_id = ?");
  $stmt->bind_param("ii", $cart_id, $size_id);
  if ($stmt->execute()) {
    $response["success"] = true;
  } else {
    $respnse["error"] = "Could not update quantity";
  }
}

header('Content-Type: application/json');
echo json_encode($response);
