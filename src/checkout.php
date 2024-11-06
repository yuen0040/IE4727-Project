<?php
session_start();
require 'db.php';
$session_id = session_id();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.html?redirect=" . urlencode("checkout.php"));
  exit();
}

//No items to checkout user should not be here
if (!isset($_SESSION['checkout'])) {
  header("Location: home.html");
  exit();
}

$user_id = $_SESSION['user_id'];
$items = $_SESSION['checkout'];
$total = $_SESSION['checkout_subtotal'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$result = $result->fetch_assoc();
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
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0&icon_names=credit_card" />
  <link href="./output.css" rel="stylesheet" />
  <title>Checkout</title>
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

    const validateForm = () => {
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

      return isValid;
    }
  </script>
</head>

<body>
  <div id="header"></div>
  <main class="mx-auto w-full max-w-[1400px] p-4 md:p-12" id="main-content">
    <h1 class="mb-12 text-4xl font-medium">Checkout</h1>
    <div class="flex flex-col justify-center gap-12 lg:flex-row lg:gap-24">
      <section class="flex flex-1 flex-col gap-8">
        <form method="POST" action="orderConfirmation.php" onsubmit="return validateForm()" class="flex flex-col gap-12">
          <div class="flex flex-col gap-6">
            <h6 class="text-2xl font-medium">Address</h6>
            <div class="flex gap-3">
              <label class="w-full font-medium">First Name

                <input
                  type="text"
                  name="first-name"
                  id="first-name"
                  placeholder="John"
                  required
                  pattern="[A-Za-z][A-Za-z\s]*"
                  title="Please enter only letters and spaces"
                  <?php echo "value='{$result['first_name']}'"; ?>
                  class="mt-2 w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900" />
                <p id="first-name-error" class="mt-1 hidden text-sm text-red-500">
                  Invalid first name
                </p>
              </label>
              <label class="w-full font-medium">Last Name

                <input
                  type="text"
                  name="last-name"
                  id="last-name"
                  placeholder="Appleseed"
                  required
                  pattern="[A-Za-z][A-Za-z\s]*"
                  <?php echo "value='{$result['first_name']}'"; ?>
                  class="mt-2 w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900" />
                <p id="last-name-error" class="mt-1 hidden text-sm text-red-500">
                  Invalid last name
                </p>
              </label>
            </div>
            <label class="w-full font-medium">Address

              <input
                type="text"
                name="address"
                id="address"
                required
                pattern="^[#.0-9a-zA-Z\s,-]+$"
                placeholder="e.g. Blk 221 #04-25 Hougang Ave 6"
                <?php if (isset($result['address'])) echo "value='{$result['address']}'" ?>
                class="mt-2 w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900" />
              <p id="address-error" class="mt-1 hidden text-sm text-red-500">
                Invalid address
              </p>
            </label>
            <label class="w-full font-medium">Postal Code

              <input
                type="number"
                name="postal-code"
                id="postal-code"
                pattern="^[0-9]{6}$"
                required
                <?php if (isset($result['postal_code'])) echo "value='{$result['postal_code']}'" ?>
                class="mt-2 w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900 [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none" />
              <p id="postal-error" class="mt-1 hidden text-sm text-red-500">
                Invalid postal code
              </p>
            </label>
            <label class="w-full font-medium">Phone Number

              <input
                type="tel"
                name="phone"
                id="phone"
                placeholder="+65XXXXXXXX"
                pattern="^\+?\d+(-\d+)*$"
                <?php if (isset($result['phone_number'])) echo "value='{$result['phone_number']}'" ?>
                required
                class="mt-2 w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900" />
              <p id="phone-error" class="mt-1 hidden text-sm text-red-500">
                Invalid phone number
              </p>
            </label>
            <label>
              <input type="checkbox" name="save-address" id="save-address" checked />
              Save this address
            </label>
          </div>
          <div>
            <h6 class="mb-6 text-2xl font-medium">Payment Option</h6>
            <div class="flex flex-wrap gap-3">
              <label class="min-w-fit flex-grow">
                <input
                  type="radio"
                  name="payment-method"
                  id="credit"
                  value="credit"
                  checked
                  class="peer/credit sr-only" />
                <div
                  class="flex cursor-pointer items-center gap-3 rounded-lg border border-zinc-200 px-4 py-3 font-medium text-zinc-900 outline outline-0 outline-offset-4 outline-blue-700 ring-0 ring-zinc-900 transition-shadow peer-checked/credit:ring-2 peer-focus-visible/credit:outline-2">
                  <span class="material-symbols-outlined text-[32px]">
                    credit_card
                  </span>
                  Credit or Debit Card
                </div>
              </label>
              <label class="min-w-fit flex-grow">
                <input
                  type="radio"
                  name="payment-method"
                  id="credit"
                  value="credit"
                  class="peer/paynow sr-only" />
                <div
                  class="flex cursor-pointer items-center gap-3 rounded-lg border border-zinc-200 px-4 py-3 font-medium text-zinc-900 outline outline-0 outline-offset-4 outline-blue-700 ring-0 ring-zinc-900 transition-shadow peer-checked/paynow:ring-2 peer-focus-visible/paynow:outline-2">
                  <img src="../assets/paynow.png" alt="paynow" />
                  Paynow
                </div>
              </label>
            </div>
          </div>
          <button
            type="submit"
            class="flex w-full items-center justify-center rounded-full bg-zinc-900 px-12 py-4 font-medium text-white transition-colors hover:bg-zinc-900/90">
            Place Order
          </button>
        </form>
      </section>
      <section class="flex w-full flex-col gap-8 lg:max-w-80">
        <div class="flex flex-col gap-6">
          <h6 class="text-2xl font-medium">Order Summary</h6>
          <div class="flex flex-col gap-1 text-zinc-700">
            <div class="flex justify-between">
              <p>Subtotal</p>
              <p>$<?php echo number_format($total, 2) ?></p>
            </div>
            <div class="flex justify-between">
              <p>Delivery</p>
              <p><?php if ($total > 75) echo "Free";
                  else echo "$10.00";
                  ?></p>
            </div>
          </div>
          <div class="flex justify-between font-medium">
            <p>Total</p>
            <p>$<?php
                if ($total <= 75) $total += 10;
                echo number_format($total, 2);
                ?></p>
          </div>
        </div>
        <div class="h-px w-full bg-zinc-200"></div>
        <?php
        foreach ($items as $row) {
          if (isset($row['sale_price'])) {
            $price = $row['sale_price'];
          } else {
            $price = $row['price'];
          }
          $total += (float)$price * $row['quantity'];
          echo "<div class='flex gap-3'>
                  <div class='aspect-square size-32 bg-zinc-200'>
                    <img src='{$row['image_url']}' alt='{$row['name']}' class='object-cover size-full'/>
                  </div>
                  <div class='text-sm text-zinc-700'>
                    <p class='mb-3 text-zinc-900'>{$row['name']}</p>
                    <div>
                      <p>Size: US{$row['size']}</p>
                      <p>Colour: {$row['colour']}</p>
                      <p>Quantity: {$row['quantity']}</p>
                      <p class='text-zinc-900'>";
          if (isset($row['sale_price'])) {
            echo "<p><span class=' text-red-500'>$" . number_format($row['sale_price'], 2) . "</span> <span class='text-zinc-400 line-through'>$" . number_format($row['price'], 2) . "</span></p>";
          } else {
            echo "<p>$" . number_format($row['price'], 2) . "</p>";
          }
          echo        "</p>
                      </div>
                    </div>
                  </div>";
        }
        ?>
      </section>
    </div>
  </main>
  <div id="footer"></div>
</body>

</html>