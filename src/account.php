<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html");
  exit();
}
if ($_SERVER['QUERY_STRING']) {
  $extension = "?" . $_SERVER['QUERY_STRING'];
} else {
  $extension = "";
}


header("Location: account.html" . $extension);
