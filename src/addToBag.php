<?php
//Adds items to bag. There's a lot of nested if elses here which is bad but I'm too lazy to refactor it
require 'db.php';
session_start();
$session_id = session_id();
$size_id = $_GET['size'];
$response = array();

function insertIntoCartItems($conn, int|string $size_id_insert, int|string $cart_id_insert, array &$response)
{
  $stmt = $conn->prepare("INSERT INTO cart_items VALUES (NULL,?,?,1)");
  $stmt->bind_param("ii", $cart_id_insert, $size_id_insert);
  if ($stmt->execute()) {
    $response["success"] = true;
  } else {
    $response["error"] = "Unable to add item to bag.";
  }
}

function addToCartItems($conn, int|string $size_id_insert, int|string $cart_id_insert, int $current_quantity, array &$response)
{
  $quantity = $current_quantity + 1;
  $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE size_id = ? AND cart_id = ?");
  $stmt->bind_param("iii", $quantity, $size_id_insert, $cart_id_insert);
  if ($stmt->execute()) {
    $response["success"] = true;
  } else {
    $response["error"] = "Unable to add item to bag.";
  }
}

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  //Logged in
  $stmt = $conn->prepare("SELECT cart.cart_id, size_id, session_id, quantity FROM cart_items RIGHT JOIN cart ON cart.cart_id = cart_items.cart_id WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // If no cart, create cart then add item into it
  if ($result->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO cart VALUES (NULL,?,?)");
    $stmt->bind_param("si", $session_id, $user_id);
    $stmt->execute();
    $user_cart_id = $stmt->insert_id;

    insertIntoCartItems($conn, $size_id, $user_cart_id, $response);
  } else {
    $user_cart_data = array();
    while ($row = $result->fetch_assoc()) {
      if (!isset($user_cart_id)) {
        $user_cart_id = $row['cart_id'];
      }
      if (!isset($user_cart_session_id)) {
        $user_cart_session_id = $row['session_id'];
      }
      $user_cart_data[$row['size_id']] =  $row['quantity'];
    }

    //Update session id if needed
    if ($user_cart_session_id != $session_id) {
      $stmt = $conn->prepare("UPDATE cart SET session_id = ? WHERE user_id = ?");
      $stmt->bind_param("si", $session_id, $user_id);
      $stmt->execute();
    }

    // Item already exists in cart
    if (isset($user_cart_data[$size_id])) {
      if ($user_cart_data[$size_id] >= 5) {
        $response["error"] = "Cannot have more than 5 of the same item in bag.";
      } else {
        addToCartItems($conn, $size_id, $user_cart_id, $user_cart_data[$size_id], $response);
      }
    } else {
      insertIntoCartItems($conn, $size_id, $user_cart_id, $response);
    }
  }
} else {
  //Not logged in
  $stmt = $conn->prepare("SELECT cart.cart_id, size_id, quantity FROM cart_items RIGHT JOIN cart ON cart.cart_id = cart_items.cart_id WHERE session_id = ?");
  $stmt->bind_param("s", $session_id);
  $stmt->execute();
  $result = $stmt->get_result();

  // If no session cart, create cart then add item into it
  if ($result->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO cart VALUES (NULL,?,NULL)");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $session_cart_id = $stmt->insert_id;

    insertIntoCartItems($conn, $size_id, $session_cart_id, $response);
  } else {
    $session_cart_data = array();
    while ($row = $result->fetch_assoc()) {
      if (!isset($session_cart_id)) {
        $session_cart_id = $row['cart_id'];
      }
      $session_cart_data[$row['size_id']] =  $row['quantity'];
    }
    // Item already exists in cart
    if (isset($session_cart_data[$size_id])) {
      if ($session_cart_data[$size_id] >= 5) {
        $response["error"] = "Cannot have more than 5 of the same item in bag";
      } else {
        addToCartItems($conn, $size_id, $session_cart_id, $session_cart_data[$size_id], $response);
      }
    } else {
      insertIntoCartItems($conn, $size_id, $session_cart_id, $response);
    }
  }
}


header('Content-Type: application/json');
echo json_encode($response);
