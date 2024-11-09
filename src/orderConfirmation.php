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

$message = "<table align='center' border='0' style='max-width:768px;border:0px;'>
            <thead>
              <tr>
                <td colspan='2'>
                  <a href='http://localhost/ie4727-project/src' style='margin:0px;'>
                    <img src='http://localhost/ie4727-project/assets/logos/logo_horizontal_big.png' alt='SoleGood' style='height:48px;'/>
                  </a>
                </td>
              </tr>
              <tr>
                <td colspan='2' style='padding-bottom:24px;'>
                  <h1 style='margin:0px;margin-bottom:8px;font-size:36px;line-height:40px;color:#18181b;'>Your Order Has Been Confirmed!</h1>
                  <p style='margin:0px;color:#3f3f46;'>Items Ordered:</p>
                </td>
              </tr>
            </thead>
            <tbody>";
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
                      <p class='text-2xl font-medium'>{$row['name']}</p>";
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
          $message .= "<tr>
                          <td style='vertical-align:top;'>
                            <img src='{$row['image_url']}' alt='{$row['name']}' style='width:192px;height:192px;object-fit:cover;border-radius:12px;'/>
                          </td>
                          <td style='vertical-align:top;text-align:left;'>
                            <div style='display:block;margin-bottom:24px;'>
                              <p style='font-size:24px;line-height:32px;font-weight:500;margin:0px;color:#18181b;'>{$row['name']}</p>";
          if (isset($row['sale_price'])) {
            $message .= "<p style='margin:0px;'><span style='font-size:18px;line-height:28px;color:#ef4444;'>$" . number_format($row['sale_price'], 2) . "</span> <span style='font-size:18px;line-height:28px;color:#a1a1aa;text-decoration-line: line-through;'>$" . number_format($row['price'], 2) . "</span></p>";
          } else {
            $message .= "<p style='margin:0px;color:#18181b;'>$" . number_format($row['price'], 2) . "</p>";
          }
          $message .= "</div>
                      <div style='color:#3f3f46;'>
                        <p style='margin:0px;'>Size: US{$row['size']}</p>
                        <p style='margin:0px;'>Colour: {$row['colour']}</p>
                        <p style='margin:0px;'>Quantity: {$row['quantity']}</p>
                      </div>
                    </td>
                  </tr>";
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

<?php
if ($subtotal > 75) $delivery = "Free";
else $delivery = "$10.00";
$to = "f31ee@localhost";
$subject = "Order Has Been Placed Successfully!";
$message .= "<tr>
              <td colspan='2' style='padding-top:24px;padding-bottom:16px;text-align:left;'>
                <h6 style='margin:0px;font-size:24px;line-height:32px;font-weight:500;color:#18181b;'>Order Details</h6>
              </td>
            </tr>
            <tr>
              <td colspan='2' style='text-align:left'>
                <p style='margin:0px;color:#3f3f46'>Order Date: " . date("d M Y") . "</p>
              </td>
            </tr>
            <tr>
              <td colspan='2' style='text-align:left'>
                <p style='margin:0px;color:#3f3f46;padding-bottom:24px;'>Order Number: $order_id</p>
              </td>
            </tr>
            <tr>
              <td colspan='2' style='border:0px;border-bottom:1px solid #e4e4e7;'></td>
            </tr>
            <tr>
              <td colspan='2' style='padding-top:24px;padding-bottom:16px;text-align:left'>
                <h6 style='margin:0px;font-size:24px;line-height:32px;font-weight:500;color:#18181b;'>Delivery</h6>
              </td>
            </tr>
            <tr>
              <td colspan='2' style='text-align:left'>
                <p style='margin:0px;color:#3f3f46;'>$name</p>
              </td>
            </tr>
            <tr>
              <td colspan='2' style='text-align:left'>
                <p style='margin:0px;color:#3f3f46;'>$address</p>
              </td>
            </tr>
            <tr>
              <td colspan='2' style='text-align:left'>
                <p style='margin:0px;color:#3f3f46;'>Singapore $postal_code</p>
              </td>
            </tr>
            <tr>
              <td colspan='2' style='text-align:left'>
                <p style='margin:0px;color:#3f3f46;padding-bottom:24px;'>$phone</p>
              </td>
            </tr>
            <tr>
              <td colspan='2' style='border:0px;border-bottom:1px solid #e4e4e7;'></td>
            </tr>
            <tr>
              <td colspan='2' style='padding-top:24px;padding-bottom:16px;text-align:left'>
                <h6 style='margin:0px;font-size:24px;line-height:32px;font-weight:500;color:#18181b;'>Totals</h6>
              </td>
            </tr>
            <tr>
              <td style='text-align:left;'>
                <p style='margin:0px;color:#3f3f46;'>Subtotal</p>
              </td>
              <td style='text-align:right;'>
                <p style='margin:0px;color:#3f3f46;'>$" . number_format($subtotal, 2) . "</p>
              </td>
            </tr>
            <tr>
              <td style='text-align:left;'>
                <p style='margin:0px;color:#3f3f46;'>Delivery</p>
              </td>
              <td style='text-align:right;'>
                <p style='margin:0px;color:#3f3f46;'>$delivery</p>
              </td>
            </tr>
            <tr>
              <td style='text-align:left;'>
                <p style='margin:0px;color:#18181b;font-weight:500;'>Total</p>
              </td>
              <td style='text-align:right;'>
                <p style='margin:0px;color:#18181b;font-weight:500;'>$" . number_format($total, 2) . "</p>
              </td>
            </tr>
            <tr>
              <td colspan='2' align='center' style='padding-top:24px;padding-bottom:24px;'>
                <a href='http://localhost/ie4727-project/src/manageOrder.php?no=$order_id' style='border-radius:64px;border:1px solid #e4e4e7;padding:12px;padding-left:32px;padding-right:32px;font-weight:500;text-decoration:none;color:#18181b;'>Manage Order</a>
              </td>
            </tr>
          </tbody>
        </table>";
$headers = 'From: SoleGood@localhost' . "\r\n" . 'Reply-To: SoleGood@localhost' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
mail(
  $to,
  $subject,
  $message,
  $headers,
  '-fSoleGood@localhost'
);
?>