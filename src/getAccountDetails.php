<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
require 'db.php';

$details = isset($_GET['details']);
$user_id = $_SESSION['user_id'];

if ($details) {
  $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $result = $result->fetch_assoc();

  header('Content-Type: application/json');
  echo json_encode($result);
}
