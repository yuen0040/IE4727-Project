<?php


session_start();
require 'db.php';

//Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: home.html");
  exit();
}

$user_id = $_SESSION['user_id'];

//Redirect if user is not logged in
if (!isset($_GET['no'])) {
  header("Location: account.php?history=true");
  exit();
}

$order_id = $_GET['no'];

$stmt = $conn->prepare("SELECT users.user_id, orders.first_name, orders.last_name, orders.postal_code, orders.phone_number, orders.created_at, name, colour, order_status, order_total, shipping_address as address, unit_price, quantity, size, image_url 
                        FROM order_items INNER JOIN orders ON orders.order_id = order_items.order_id 
                        INNER JOIN sizes ON order_items.size_id = sizes.size_id 
                        INNER JOIN products ON products.product_id = sizes.product_id 
                        INNER JOIN images ON images.product_id = products.product_id 
                        INNER JOIN users ON users.user_id = orders.user_id 
                        WHERE orders.order_id = ? 
                        GROUP BY sizes.size_id; ");
$stmt->bind_param("i",  $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
  header("Location: 404.html");
  exit();
}

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
  <title>Manage Order</title>
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
  </script>
</head>

<body>
  <div id="header"></div>
  <main id="main-content" class="mx-auto w-full max-w-[1400px] p-4 md:p-12">
    <dialog class="max-w-lg bg-white rounded-2xl p-8 open:flex flex-col gap-6 backdrop:bg-black/80 backdrop:backdrop-blur-sm">
      <h3 class="text-2xl font-medium text-zinc-900">Are you sure you want to cancel your order?</h3>
      <p class="text-zinc-700">You will not be able to undo this action.</p>
      <p id="alert-error-cancel" class="hidden text-sm text-red-500"></p>
      <div class="flex justify-end gap-4 mt-6">
        <form method="dialog">
          <button type="submit" class="rounded-full text-zinc-700 px-5 py-2 font-medium hover:bg-zinc-100/90 transition-colors">Go Back</button>
        </form>
        <form id="cancel" onsubmit="return cancelOrder()">
          <input name="order-id" type="hidden" value="<?php echo $order_id ?>" />
          <button type="submit" class="rounded-full bg-red-700 text-white px-5 py-2 font-medium hover:bg-red-700/90 transition-colors">Cancel Order</button>
        </form>
      </div>
    </dialog>
    <h1 class="mb-12 text-4xl font-medium">Manage Order</h1>
    <div class="flex flex-col justify-center gap-12 lg:flex-row lg:gap-24">
      <section class="flex flex-1 flex-col gap-8">
        <?php
        while ($row = $result->fetch_assoc()) {
          // Not allowed to view
          if ($row['user_id'] !== $user_id) {
            header("Location: account.php?history=true");
            exit();
          }
          if (!isset($first_name) && !isset($last_name) && !isset($address) && !isset($phone_number) && !isset($postal_code) && !isset($order_date) && !isset($status) && !isset($order_total)) {
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $address = $row['address'];
            $phone_number = $row['phone_number'];
            $postal_code = $row['postal_code'];
            $order_date = strtotime($row['created_at']);
            $status = $row['order_status'];
            $order_total = $row['order_total'];
          }
          $link = "product.html?name=" . urlencode($row['name']);
          echo "<div class='flex w-full gap-8'>
                  <a href='$link' class='aspect-square size-32 bg-zinc-200 md:size-64 rounded-xl'>
                    <img src='{$row['image_url']}' alt='{$row['name']}' class='size-full object-cover rounded-xl' />
                  </a>
                  <div class='flex w-full flex-col gap-6'>
                    <div>
                      <a href='$link' class='text-2xl font-medium'>{$row['name']}</a>
                      <p class='text-lg font-medium'>$" . number_format($row['unit_price'], 2) . "</p>
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
          <p class="mb-1">Order Date: <?php echo date("d M Y", $order_date) ?></p>
          <p class="mb-1">Order Number: <?php echo $order_id ?></p>
          <p>Status: <?php echo $status ?></p>
        </div>

        <div class="h-px bg-zinc-200"></div>

        <div class="flex flex-col items-start gap-6 text-zinc-700">
          <h6 class="text-2xl font-medium text-zinc-900">Delivery</h6>
          <form
            id="address-form"
            class="hidden max-w-2xl flex-col items-start gap-4"
            onsubmit="return validateAddress()">
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label
                  class="mb-2 block font-medium text-zinc-900"
                  for="first-name">First Name</label>
                <input
                  class="w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900"
                  type="text"
                  id="first-name"
                  name="first-name"
                  placeholder="John"
                  required
                  <?php echo "value='{$first_name}'" ?>
                  title="Please enter only letters and spaces" />
                <p
                  id="first-name-error"
                  class="mt-1 hidden text-sm text-red-500">
                  Invalid first name
                </p>
              </div>
              <div>
                <label
                  class="mb-2 block font-medium text-zinc-900"
                  for="last-name">Last Name</label>
                <input
                  class="w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900"
                  type="text"
                  id="last-name"
                  name="last-name"
                  placeholder="Appleseed"
                  required
                  <?php echo "value='{$last_name}'" ?>
                  title="Please enter only letters and spaces" />
                <p
                  id="last-name-error"
                  class="mt-1 hidden text-sm text-red-500">
                  Invalid last name
                </p>
              </div>
            </div>
            <div class="w-full">
              <label
                class="mb-2 block font-medium text-zinc-900"
                for="address">Address
              </label>
              <input
                type="text"
                name="address"
                id="address"
                required
                <?php echo "value='{$address}'" ?>
                placeholder="e.g. Blk 221 #04-25 Hougang Ave 6"
                class="w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900" />
              <p id="address-error" class="mt-1 hidden text-sm text-red-500">
                Invalid address
              </p>
            </div>
            <div class="w-full">
              <label
                class="mb-2 block font-medium text-zinc-900"
                for="postal-code">Postal Code
              </label>
              <input
                type="number"
                name="postal-code"
                id="postal-code"
                required
                <?php echo "value='{$postal_code}'" ?>
                class="w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow [appearance:textfield] focus:outline-none focus:ring-2 focus:ring-zinc-900 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none" />
              <p id="postal-error" class="mt-1 hidden text-sm text-red-500">
                Invalid postal code
              </p>
            </div>
            <div class="w-full">
              <label class="mb-2 block font-medium text-zinc-900" for="phone">Phone Number
              </label>
              <input
                type="tel"
                name="phone"
                id="phone"
                placeholder="+65XXXXXXXX"
                required
                <?php echo "value='{$phone_number}'" ?>
                class="w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900" />
              <p id="phone-error" class="mt-1 hidden text-sm text-red-500">
                Invalid phone number
              </p>
            </div>
            <input type="hidden" id="order-id" name="order-id" value="<?php echo $order_id ?>" />
            <div class="space-x-4">
              <button
                class="font-medium text-zinc-700"
                onclick="hideAddressForm()">
                Cancel
              </button>
              <button type="submit" class="font-medium underline">
                Save
              </button>
            </div>
            <p
              id="alert-error-address"
              class="hidden text-center text-red-500"></p>
          </form>
          <div id="address-display" class="flex flex-col gap-1">
            <p id="user-name"><?php echo $first_name . " " . $last_name ?></p>
            <p id="user-address"><?php echo $address ?></p>
            <p>Singapore <span id="user-postal"><?php echo $postal_code ?></span></p>
            <p id="user-phone"><?php echo $phone_number ?></p>
          </div>
          <button
            id="edit-button"
            class="font-medium underline"
            onclick="showAddressForm()">
            Edit
          </button>
        </div>

        <div class="h-px bg-zinc-200"></div>

        <div>
          <h6 class="mb-6 text-2xl font-medium text-zinc-900">Totals</h6>
          <div class="flex flex-col gap-1">
            <div class="flex w-full justify-between text-zinc-700">
              <p>Subtotal</p>
              <p>$<?php
                  if ($order_total > 85) echo number_format($order_total, 2);
                  else echo number_format($order_total - 10, 2);
                  ?></p>
            </div>
            <div class="flex w-full justify-between text-zinc-700">
              <p>Delivery</p>
              <p><?php
                  if ($order_total > 85) echo "Free";
                  else echo "$10.00";
                  ?></p>
            </div>
            <div class="flex w-full justify-between font-medium">
              <p>Total</p>
              <p>$<?php echo $order_total ?></p>
            </div>
          </div>
        </div>

        <button
          onclick="showConfirmation()"
          class="flex w-full items-center justify-center rounded-full border border-red-300 px-5 py-2 font-medium text-red-700 transition-colors hover:bg-red-50">
          Cancel Order
        </button>
      </section>
    </div>
  </main>
  <div id="footer"></div>
  <script>
    const showConfirmation = () => {
      document.querySelector("dialog").showModal();
    }
    const showAddressForm = () => {
      document
        .getElementById("address-form")
        .classList.replace("hidden", "flex");
      document
        .getElementById("address-display")
        .classList.replace("flex", "hidden");
      document.getElementById("edit-button").classList.add("hidden");
    };
    const hideAddressForm = () => {
      document
        .getElementById("address-display")
        .classList.replace("hidden", "flex");
      document
        .getElementById("address-form")
        .classList.replace("flex", "hidden");
      document.getElementById("edit-button").classList.remove("hidden");
    };

    function showAlert(message, category) {
      let alertBox;
      if (category === "cancel")
        alertBox = document.getElementById("alert-error-cancel");
      else if (category === "address")
        alertBox = document.getElementById("alert-error-address");
      alertBox.innerText = message;
      alertBox.classList.remove("hidden");
      setTimeout(() => {
        alertBox.classList.add("hidden");
      }, 3000); // Automatically hide after 3 seconds
    }

    const validateAddress = () => {
      const firstNameInput = document.getElementById("first-name");
      const firstNameError = document.getElementById("first-name-error");
      const lastNameInput = document.getElementById("last-name");
      const lastNameError = document.getElementById("last-name-error");
      const addressInput = document.getElementById("address");
      const addressError = document.getElementById("address-error");
      const postalCodeInput = document.getElementById("postal-code");
      const postalError = document.getElementById("postal-error");
      const phoneInput = document.getElementById("phone");
      const phoneError = document.getElementById("phone-error");

      let isValid = true;

      // First Name validation
      if (!/[A-Za-z][A-Za-z\s]*/.test(firstNameInput.value)) {
        firstNameError.textContent = firstNameInput.validity.valueMissing ?
          "First Name is required" :
          "Invalid first name";
        firstNameError.classList.remove("hidden");
        isValid = false;
      } else {
        firstNameError.classList.add("hidden");
      }

      // Last Name validation
      if (!/[A-Za-z][A-Za-z\s]*/.test(lastNameInput.value)) {
        lastNameError.textContent = lastNameInput.validity.valueMissing ?
          "Last Name is required" :
          "Invalid last name";
        lastNameError.classList.remove("hidden");
        isValid = false;
      } else {
        lastNameError.classList.add("hidden");
      }

      // Address validation
      if (!/^[#.0-9a-zA-Z\s,-]+$/.test(addressInput.value)) {
        addressError.textContent = addressInput.validity.valueMissing ?
          "Address is required" :
          "Invalid address";
        addressError.classList.remove("hidden");
        isValid = false;
      } else {
        addressError.classList.add("hidden");
      }

      // Postal code validation
      if (!/^[0-9]{6}$/.test(postalCodeInput.value)) {
        postalError.textContent = postalCodeInput.validity.valueMissing ?
          "Postal Code is required" :
          "Invalid postal code";
        postalError.classList.remove("hidden");
        isValid = false;
      } else {
        postalError.classList.add("hidden");
      }

      // Phone validation
      if (!/^\+?\d+(-\d+)*$/.test(phoneInput.value)) {
        phoneError.textContent = phoneInput.validity.valueMissing ?
          "Phone number is required" :
          "Invalid phone number";
        phoneError.classList.remove("hidden");
        isValid = false;
      } else {
        phoneError.classList.add("hidden");
      }

      if (isValid) {
        const form = document.getElementById("address-form");
        const formData = new FormData(form);
        fetch("editOrderDetails.php", {
            method: "POST",
            body: formData
          })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              hideAddressForm();
              document.getElementById("user-name").innerText =
                formData.get("first-name") + " " + formData.get("last-name");
              document.getElementById("user-address").innerText =
                formData.get("address");
              document.getElementById("user-postal").innerText =
                formData.get("postal-code");
              document.getElementById("user-phone").innerText =
                formData.get("phone");
            } else if (data.error) showAlert(data.error, "address");
          });
      }

      return false;
    };

    const cancelOrder = () => {
      const form = document.getElementById("cancel");
      const formData = new FormData(form);
      fetch("cancelOrder.php", {
        method: "POST",
        body: formData
      }).then((response) => response.json()).then((data) => {
        if (data.success) window.location.href = "account.php?history=true";
        else if (data.error) showAlert(data.error, "cancel");
      })
      return false;
    }
  </script>
</body>

</html>