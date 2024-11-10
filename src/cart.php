<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();
require 'db.php';
$session_id = session_id();

unset($_SESSION['checkout']);
unset($_SESSION['checkout_subtotal']);

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = "
        SELECT cart_items.cart_id, cart_items.size_id, quantity, stock, name, price, sale_price, size, colour, image_url from cart_items 
        INNER JOIN cart ON cart.cart_id = cart_items.cart_id 
        INNER JOIN sizes ON sizes.size_id = cart_items.size_id 
        INNER JOIN products ON products.product_id = sizes.product_id 
        INNER JOIN images ON images.product_id = products.product_id 
        WHERE cart.user_id = ?
        GROUP BY sizes.size_id; 
    ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
} else {
  $sql = "
        SELECT cart_items.cart_id, cart_items.size_id, quantity, stock, name, price, sale_price, size, colour, image_url from cart_items 
        INNER JOIN cart ON cart.cart_id = cart_items.cart_id 
        INNER JOIN sizes ON sizes.size_id = cart_items.size_id 
        INNER JOIN products ON products.product_id = sizes.product_id 
        INNER JOIN images ON images.product_id = products.product_id 
        WHERE cart.session_id = ?
        GROUP BY sizes.size_id; 
    ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $session_id);
  $stmt->execute();
  $result = $stmt->get_result();
}
$total = 0.00;
$items = array();
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
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0&icon_names=close" />
  <link href="./output.css" rel="stylesheet" />
  <title>Shopping Bag</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.min.js" defer></script>
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

    const handleQuantityChange = async (quantity, size_id, cart_id) => {
      let formData = new FormData();
      formData.append("size_id", size_id);
      formData.append("quantity", quantity);
      formData.append("cart_id", cart_id);

      await fetch("editCart.php", {
          method: "POST",
          body: formData
        }).then((data) => data.json())
        .then((data) => {
          if (data.success) {
            location.reload();
          };
        })
    }

    const handleCheckout = () => {
      window.location.href = "checkout.php";

    }
  </script>
</head>

<body>
  <div id="header"></div>
  <main id="main-content" class="mx-auto w-full max-w-[1400px] p-4 md:p-12">
    <h1 class="mb-12 text-4xl font-medium">Your Bag</h1>
    <div class="flex flex-col justify-center gap-12 lg:flex-row lg:gap-24">
      <section class="flex flex-1 flex-col gap-8">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            if (isset($row['sale_price'])) {
              $price = $row['sale_price'];
            } else {
              $price = $row['price'];
            }
            $total += (float)$price * min($row['quantity'], $row['stock']);
            if (!isset($cart_id)) {
              $cart_id = $row['cart_id'];
            }
            if ($row['stock'] > 0) {
              $link = "product.html?name=" . urlencode($row['name']);
              //Set quantity to the amount of stock left if it exceeds
              $row['quantity'] = min($row['quantity'], $row['stock']);
              $items[] = $row;

              echo "<div class='flex w-full gap-8'>
                      <a href='$link' class='aspect-square size-32 bg-zinc-200 md:size-64 rounded-xl'>
                        <img src='{$row['image_url']}' alt='{$row['name']}' class='object-cover size-full rounded-xl'/>
                      </a>
                      <div class='flex w-full flex-col gap-6'>
                        <div>
                          <div class='flex items-center justify-between gap-6'>
                            <a href='$link' class='text-2xl font-medium'>{$row['name']}</a>
                            <button class='flex size-8 items-center justify-center rounded-full hover:bg-zinc-100 transition-colors' onclick='handleQuantityChange(0, {$row['size_id']}, $cart_id)'>
                              <span class='material-symbols-outlined'> close </span>
                            </button>
                          </div>";
              if (isset($row['sale_price'])) {
                echo "<p><span class='font-medium text-red-500'>$" . number_format($row['sale_price'], 2) . "</span> <span class='text-zinc-400 line-through'>$" . number_format($row['price'], 2) . "</span></p>";
              } else {
                echo "<p class='text-lg font-medium'>$" . number_format($price, 2) . "</p>";
              }
              echo     "</div>
                        <div class='text-zinc-700'>
                          <p>Size: US{$row['size']}</p>
                          <p>Colour: {$row['colour']}</p>
                        </div>
                        <div class='text-zinc-700'>
                          <label for='quantity'>Quantity:</label>
                          <select
                            name='quantity'
                            id='quantity'
                            onchange='handleQuantityChange(this.value, {$row['size_id']}, $cart_id)'
                            class='ml-3 rounded-lg border border-zinc-200 bg-white p-3 pl-4 text-base text-zinc-900 after:block'>
                            ";
              for ($i = 1; $i <= min((int)$row['stock'], 5); $i++) {
                if ($i == (int)$row['quantity']) {
                  echo "<option value='$i' selected>$i</option>";
                } else {
                  echo "<option value='$i'>$i</option>";
                }
              }
              echo        "
                          </select>
                        </div>
                      </div>
                    </div>";
            } else {
              // No stock
              echo "<div class='flex w-full gap-8'>
              <a href='$link' class='aspect-square size-32 bg-zinc-200 md:size-64 rounded-xl'>
                <img src='{$row['image_url']}' alt='{$row['name']}' class='object-cover size-full rounded-xl'/>
              </a>
              <div class='flex w-full flex-col gap-6 text-zinc-500'>
                <div>
                  <div class='flex items-center justify-between gap-6'>
                    <a href='$link' class='text-2xl font-medium'>{$row['name']}</a>
                    <button class='flex size-8 items-center justify-center text-zinc-900 rounded-full hover:bg-zinc-100 transition-colors' onclick='handleQuantityChange(0, {$row['size_id']}, $cart_id)'>
                      <span class='material-symbols-outlined'> close </span>
                    </button>
                  </div>";
              if (isset($row['sale_price'])) {
                echo "<p><span class='font-medium text-red-500'>$" . number_format($row['sale_price'], 2) . "</span> <span class='text-zinc-400 line-through'>$" . number_format($row['price'], 2) . "</span></p>";
              } else {
                echo "<p class='text-lg font-medium'>$" . number_format($price, 2) . "</p>";
              }
              echo "</div>
                <div class='text-zinc-400'>
                  <p>Size: US{$row['size']}</p>
                  <p>Colour: {$row['colour']}</p>
                </div>
                <p class='text-red-700'>
                  Item is out of stock.
                </p>
              </div>
            </div>";
            }
          }
          // Set the session var to keep track of what's being checked out so cart merging doesn't affect things
          $_SESSION['checkout'] = $items;
          $_SESSION['checkout_subtotal'] = $total;
        } else {
          echo "<p>Your bag is empty.</p>";
        }
        ?>

      </section>
      <section class="w-full lg:max-w-80">
        <div class="mb-8 flex flex-col gap-6">
          <h6 class="text-2xl font-medium">Order Summary</h6>
          <div class="flex flex-col gap-1 text-zinc-700">
            <div class="flex justify-between">
              <p>Subtotal</p>
              <p id="subtotal">$<?php echo number_format($total, 2) ?></p>
            </div>
            <div class="flex justify-between">
              <p>Delivery</p>
              <p>
                <?php
                if (count($items) > 0) {
                  if ($total > 75) echo "Free";
                  else echo "$10.00";
                } else echo "—";
                ?></p>
            </div>
          </div>
          <div class="flex justify-between font-medium">
            <p>Total</p>
            <p id="total">
              <?php
              if (count($items) > 0) {
                if ($total <= 75) $total = $total + 10;
                echo "$" . number_format($total, 2);
              } else {
                echo "—";
              } ?>
            </p>
          </div>
        </div>
        <button
          class="flex w-full items-center justify-center rounded-full bg-zinc-900 px-12 py-4 font-medium text-white transition-colors hover:bg-zinc-900/90 disabled:bg-zinc-200 disabled:text-zinc-400 disabled:cursor-not-allowed"
          onclick="handleCheckout()"
          <?php if (count($items) == 0) echo "disabled"; ?>>
          <?php
          if (isset($_SESSION['user_id'])) {
            echo "Checkout";
          } else {
            echo "Login to Checkout";
          }
          ?>
        </button>
      </section>
    </div>
  </main>
  <div id="footer"></div>
</body>

</html>