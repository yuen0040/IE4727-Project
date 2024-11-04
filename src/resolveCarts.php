<?php

require 'db.php';

function resolveCarts(mysqli $conn, int|string $user_id)
{
  $session_id = session_id();
  $stmt = $conn->prepare("SELECT size_id, quantity, cart.cart_id FROM cart_items RIGHT JOIN cart ON cart.cart_id = cart_items.cart_id WHERE session_id = ?");
  $stmt->bind_param("s", $session_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // If no session cart, return
  if ($result->num_rows == 0) {
    return;
  }

  $session_cart_data = array();
  while ($row = $result->fetch_assoc()) {
    if (!isset($session_cart_id)) $session_cart_id = $row['cart_id'];
    $session_cart_data[$row['size_id']] =  $row['quantity'];
  }

  // This should never happen but we handle it anyway
  if ($user_id == $session_cart_id) {
    return;
  }

  $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // user cart does not exist
  if ($result->num_rows == 0) {
    // Update session cart with user id
    $stmt = $conn->prepare("UPDATE cart SET user_id = ? WHERE session_id = ?");
    $stmt->bind_param("is", $user_id, $session_id);
    $stmt->execute();
    return;
  }
  // user cart exists
  $result = $result->fetch_assoc();
  $user_cart_id = $result['cart_id'];

  // select items in user cart
  $stmt = $conn->prepare("SELECT size_id, quantity FROM cart_items WHERE cart_id = ?");
  $stmt->bind_param("i", $user_cart_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // user cart is empty
  if ($result->num_rows == 0) {
    // Delete user cart and update session cart
    $stmt = $conn->prepare("DELETE from cart WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE cart SET user_id = ? WHERE session_id = ?");
    $stmt->bind_param("is", $user_id, $session_id);
    $stmt->execute();
    return;
  }

  // User cart is not empty, combine both carts
  $user_cart_data = array();
  while ($row = $result->fetch_assoc()) {
    $user_cart_data[$row['size_id']] = $row['quantity'];
  }

  // Delete session cart and update user cart
  $stmt = $conn->prepare("DELETE from cart WHERE session_id = ?");
  $stmt->bind_param("s", $session_id);
  $stmt->execute();

  $stmt = $conn->prepare("UPDATE cart SET session_id = ? WHERE user_id = ?");
  $stmt->bind_param("si", $session_id, $user_id);
  $stmt->execute();

  foreach ($session_cart_data as $size_id => $qty) {
    // items already exists in user cart
    if (isset($user_cart_data[$size_id])) {
      $new_quantity = (int)$user_cart_data[$size_id] + (int)$qty;
      $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cart_id = ? AND size_id = ?");
      $stmt->bind_param("iii", $new_quantity, $user_cart_id, $size_id);
      $stmt->execute();
    } else {
      // insert item into user cart
      $stmt = $conn->prepare("INSERT INTO cart_items VALUES (NULL, ?, ?, ?)");
      $stmt->bind_param("iii", $user_cart_id, $size_id, $qty);
      $stmt->execute();
    }
  }
}
