<?php

//Redirect if user comes here through GET
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header("Location: home.html");
  exit();
}

session_start();
require 'db.php';

$items = $_SESSION['checkout'];
$subtotal = $_SESSION['checkout_subtotal'];
if ($subtotal <= 75) $total = $subtotal + 10;
else $total = $subtotal;
$user_id = $_SESSION['user_id'];
unset($_SESSION['checkout']);
unset($_SESSION['checkout_subtotal']);

$first_name = filter_input(INPUT_POST, 'first-name', FILTER_UNSAFE_RAW);
$last_name = filter_input(INPUT_POST, 'last-name', FILTER_UNSAFE_RAW);
$address = filter_input(INPUT_POST, 'address', FILTER_UNSAFE_RAW);
$postal_code = filter_input(INPUT_POST, 'postal-code', FILTER_UNSAFE_RAW);
$phone = filter_input(INPUT_POST, 'phone', FILTER_UNSAFE_RAW);
$name = $first_name . " " . $last_name;

//Save address to user
if (isset($_POST['save-address'])) {
  $stmt = $conn->prepare("UPDATE users SET phone_number = ?, address = ?, postal_code = ? WHERE user_id = ?");
  $stmt->bind_param("ssii", $phone, $address, $postal_code, $user_id);
  $stmt->execute();
}
//Add order
$order_stmt = $conn->prepare("INSERT INTO orders VALUES (NULL,?,?,?,?,?,?,?,'preparing',DEFAULT)");
$order_stmt->bind_param("isssssi", $user_id, $total, $address, $first_name, $last_name, $phone, $postal_code);
$order_stmt->execute();
$order_id = $order_stmt->insert_id;

//Get current items from cart
$stmt = $conn->prepare("SELECT cart.cart_id, size_id, quantity FROM cart_items RIGHT JOIN cart ON cart.cart_id = cart_items.cart_id WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $user_cart_data = array();
  while ($row = $result->fetch_assoc()) {
    if (!isset($user_cart_id)) {
      $user_cart_id = $row['cart_id'];
    }
    $user_cart_data[$row['size_id']] =  $row['quantity'];
  }
}

$values = "";
$counter = 0;
foreach ($items as $row) {
  $counter += 1;
  if (isset($row['sale_price'])) {
    $price = $row['sale_price'];
  } else {
    $price = $row['price'];
  }
  $values = $values . "(NULL,$order_id,{$row['size_id']},{$row['quantity']},$price)";
  if ($counter < count($items)) {
    $values = $values . ",";
  }
  //Remove checkout items from cart
  if (isset($user_cart_data[$row['size_id']]) && $user_cart_data[$row['size_id']] > $row['quantity']) {
    $remaining = $user_cart_data[$row['size_id']] - $row['quantity'];
    $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE cart_id = ? AND size_id = ?");
    $stmt->bind_param("iii", $remaining, $user_cart_id, $row['size_id']);
    $stmt->execute();
  } else {
    $stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_id = ? AND size_id = ?");
    $stmt->bind_param("ii", $user_cart_id, $row['size_id']);
    $stmt->execute();
  }

  // Update stock
  $stmt = $conn->prepare("UPDATE sizes SET stock = stock - ? WHERE size_id = ?");
  $stmt->bind_param("ii", $row['quantity'], $row['size_id']);
  $stmt->execute();
}

//Insert items into order_items
$stmt = $conn->prepare("INSERT INTO order_items VALUES $values");
$stmt->execute();

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet" />
  <link href="./output.css" rel="stylesheet" />
  <title>Order Success</title>
  <script>
    async function loadContent() {
      // Load header
      const headerResponse = await fetch("header.html");
      const headerData = await headerResponse.text();
      document.getElementById("header").outerHTML = headerData;

      // Load footer
      const footerResponse = await fetch("footer.html");
      const footerData = await footerResponse.text();
      document.getElementById("footer").outerHTML = footerData;

      // Show the main content after loading header and footer
      document.getElementById("main-content").style.display = "block";
    }

    // Load content when the DOM is fully loaded
    document.addEventListener("DOMContentLoaded", () => {
      document.getElementById("main-content").style.display = "none"; // Hide main content initially
      loadContent();
    });
  </script>
</head>

<body>
  <div id="header"></div>
  <main class="mx-auto w-full max-w-[1400px] p-4 md:p-12" id="main-content">
    <div class="mb-12">
      <h1 class="mb-3 text-4xl font-medium">
        Your Order Was Placed Successfully!
      </h1>
      <p class="text-zinc-700">
        Check your email for your order confirmation.
      </p>
    </div>
    <div class="flex flex-col justify-center gap-12 lg:flex-row lg:gap-24">
      <section class="flex flex-1 flex-col gap-8">
        <?php
        foreach ($items as $row) {
          echo "<div class='flex w-full gap-8'>
                  <div class='aspect-square size-32 bg-neutral-200 md:size-64 rounded-xl'>
                    <img src='{$row['image_url']}' alt='{$row['name']}' class='size-full object-cover rounded-xl'/>
                  </div>
                  <div class='flex w-full flex-col gap-6'>
                    <div>
                      <a class='text-2xl font-medium'>{$row['name']}</a>";
          if (isset($row['sale_price'])) {
            echo "<p><span class='text-lg text-red-500'>$" . number_format($row['sale_price'], 2) . "</span> <span class='text-lg text-zinc-400 line-through'>$" . number_format($row['price'], 2) . "</span></p>";
          } else {
            echo "<p>$" . number_format($row['price'], 2) . "</p>";
          }
          echo      "
                    </div>
                    <div class='text-zinc-700'>
                      <p>Size: US{$row['size']}</p>
                      <p>Colour: {$row['colour']}</p>
                      <p>Quantity: {$row['quantity']}</p>
                    </div>
                  </div>
                </div>";
        }
        ?>
      </section>
      <section class="flex w-full flex-col gap-8 lg:max-w-80">
        <h6 class="text-2xl font-medium">Order Details</h6>
        <div class="text-zinc-700">
          <p class="mb-1">Order Date: <?php echo date("d M Y") ?></p>
          <p>Order Number: <?php echo $order_id ?></p>
        </div>

        <div class="h-px bg-zinc-200"></div>

        <div class="text-zinc-700">
          <h6 class="mb-6 text-2xl font-medium text-zinc-900">Delivery</h6>
          <div class="flex flex-col gap-1">
            <p><?php echo $name ?></p>
            <p><?php echo $address ?></p>
            <p>Singapore <?php echo $postal_code ?></p>
            <p><?php echo $phone ?></p>
          </div>
        </div>

        <div class="h-px bg-zinc-200"></div>

        <div>
          <h6 class="mb-6 text-2xl font-medium text-zinc-900">Totals</h6>
          <div class="flex flex-col gap-1">
            <div class="flex w-full justify-between text-zinc-700">
              <p>Subtotal</p>
              <p>$<?php
                  echo number_format($subtotal, 2);
                  ?></p>
            </div>
            <div class="flex w-full justify-between text-zinc-700">
              <p>Delivery</p>
              <p><?php
                  if ($subtotal > 75) echo "Free";
                  else echo "$10.00";
                  ?></p>
            </div>
            <div class="flex w-full justify-between font-medium">
              <p>Total</p>
              <p>$<?php echo number_format($total, 2) ?></p>
            </div>
          </div>
        </div>

        <a
          href="<?php echo "manageOrder.php?no=" . $order_id ?>"
          class="flex w-full items-center justify-center rounded-full border border-zinc-200 px-5 py-2 font-medium transition-colors hover:bg-zinc-100">
          Manage Order
        </a>
      </section>
    </div>
  </main>
  <div id="footer"></div>
</body>

</html>