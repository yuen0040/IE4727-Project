<?php

require 'db.php';

function resolveCarts(mysqli $conn, int|string $user_id)
{
  $session_id = session_id();
  $stmt = $conn->prepare("SELECT size_id, quantity FROM cart_items LEFT JOIN cart ON cart.cart_id = cart_items.cart_id WHERE session_id = ?");
  $stmt->bind_param("i", $session_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // If no session cart, return
  if ($result->num_rows == 0) {
    return;
  }

  $session_cart_data = array();
  while ($row = $result->fetch_assoc()) {
    $session_cart_data[$row['size_id']] =  $row['quantity'];
  }

  $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // user cart does not exist
  if ($result->num_rows == 0) {
    $stmt = $conn->prepare("UPDATE cart SET user_id = ? WHERE session_id = ?");
    $stmt->bind_param("ii", $user_id, $session_id);
    $stmt->execute();

    // user cart exists
  } else {
    $result = $result->fetch_assoc();
    $user_cart_id = $result['cart_id'];

    $stmt = $conn->prepare("SELECT size_id, quantity FROM cart_items WHERE cart_id = ?");
    $stmt->bind_param("i", $user_cart_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // user cart is empty
    if ($result->num_rows == 0) {
      // Delete user cart and update session cart
      $stmt = $conn->prepare("DELETE from cart WHERE user_id = ?");
      $stmt->bind_param("i", $user_cart_id);
      $stmt->execute();

      $stmt = $conn->prepare("UPDATE cart SET user_id = ? WHERE session_id = ?");
      $stmt->bind_param("ii", $user_id, $session_id);
      $stmt->execute();
    }

    $user_cart_data = array();
    while ($row = $result->fetch_assoc()) {
      $user_cart_data[$row['size_id']] = $row['quantity'];
    }

    // Delete session cart and update user cart
    $stmt = $conn->prepare("DELETE from cart WHERE session_id = ?");
    $stmt->bind_param("i", $session_id);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE cart SET session_id = ? WHERE user_id = ?");
    $stmt->bind_param("ii", $session_id, $user_id);
    $stmt->execute();

    foreach ($session_cart_data as $size_id => $qty) {
      // items already exists in user cart
      if (isset($user_cart_data[$size_id])) {
        $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE user_id = ?");
        $stmt->bind_param("ii", (int)$user_cart_data[$size_id] + (int)$qty, $user_id);
        $stmt->execute();
      } else {
        // insert item into user cart
        $stmt = $conn->prepare("INSERT INTO cart_items VALUES (NULL, ?, ?, ?)");
        $stmt->bind_param("iii", $user_cart_id, $size_id, $qty);
        $stmt->execute();
      }
    }
  }
}
