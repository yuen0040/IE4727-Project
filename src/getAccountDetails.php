<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
require 'db.php';

$details = isset($_GET['details']);
$user_id = $_SESSION['user_id'];
header('Content-Type: application/json');

if ($details) {
  $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $result = $result->fetch_assoc();

  echo json_encode($result);
} else {
  $stmt = $conn->prepare("SELECT orders.order_id as id, orders.created_at as date, order_total as total, GROUP_CONCAT(image_url SEPARATOR '|') as image_urls
                          FROM orders 
                          INNER JOIN order_items ON order_items.order_id = orders.order_id 
                          INNER JOIN sizes ON order_items.size_id = sizes.size_id 
                          INNER JOIN products ON products.product_id = sizes.product_id 
                          INNER JOIN (SELECT product_id, image_url from images GROUP BY product_id) as i ON i.product_id = products.product_id 
                          WHERE orders.user_id = ?
                          GROUP BY orders.order_id
                          ORDER BY orders.created_at DESC;");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $result = $result->fetch_all(MYSQLI_ASSOC);

  echo json_encode($result);
}
