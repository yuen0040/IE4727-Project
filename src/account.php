<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
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
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=logout" />
  <link href="./output.css" rel="stylesheet" />
  <title>My Account</title>
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
    <div class="mb-8 flex flex-wrap items-center justify-between gap-8">
      <h1 class="text-4xl font-medium">My Account</h1>
      <button
        onclick="logout()"
        class="flex items-center justify-center gap-2 rounded-full border border-red-300 py-2 pl-5 pr-3 font-medium text-red-700 transition-colors hover:bg-red-50">
        Logout
        <span class="material-symbols-outlined"> logout </span>
      </button>
    </div>
    <div class="mb-12 flex border-b border-zinc-200 text-lg" role="tablist">
      <button
        class="cursor-pointer border-b-2 border-zinc-900 px-3 py-2 text-zinc-900 transition-colors hover:bg-zinc-50"
        role="tab"
        id="details-tab"
        onclick="onTabClick(false)">
        Account Details
      </button>
      <button
        class="cursor-pointer border-b-2 border-transparent px-3 py-2 text-zinc-500 transition-colors hover:bg-zinc-50"
        role="tab"
        id="history-tab"
        onclick="onTabClick(true)">
        Order History
      </button>
    </div>
    <div
      id="fade-container"
      class="opacity-0 transition-opacity duration-300">
      <section id="details" class="hidden flex-col gap-12">
        <div class="flex flex-col gap-4 md:flex-row">
          <h6
            class="w-60 text-2xl font-medium text-zinc-900 md:flex-shrink-0">
            Personal Details
          </h6>
          <form
            id="personal-form"
            class="hidden max-w-2xl flex-col items-start gap-4"
            onsubmit="return validatePersonal()">
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
                  title="Please enter only letters and spaces" />
                <p
                  id="last-name-error"
                  class="mt-1 hidden text-sm text-red-500">
                  Invalid last name
                </p>
              </div>
            </div>
            <div>
              <p class="mb-2 font-medium text-zinc-900" for="email">Gender</p>
              <div class="space-x-2">
                <label>
                  <input
                    type="radio"
                    name="gender"
                    id="gender-male"
                    value="Male" />
                  Male
                </label>
                <label>
                  <input
                    type="radio"
                    name="gender"
                    id="gender-female"
                    value="Female" />
                  Female
                </label>
                <label>
                  <input
                    type="radio"
                    name="gender"
                    id="gender-unspecified"
                    value="Unspecified"
                    checked />
                  Unspecified
                </label>
              </div>
            </div>
            <div class="space-x-4">
              <button
                class="font-medium text-zinc-700"
                onclick="hidePersonalForm()">
                Cancel
              </button>
              <button type="submit" class="font-medium underline">
                Save
              </button>
            </div>
            <p
              id="alert-error-personal"
              class="hidden text-center text-red-500"></p>
          </form>
          <div
            id="personal-display"
            class="flex flex-col items-start gap-4 text-zinc-900">
            <div>
              <p class="text-sm font-medium text-zinc-700">Name</p>
              <p id="user-name">Loading...</p>
            </div>
            <div>
              <p class="text-sm font-medium text-zinc-700">Gender</p>
              <p id="user-gender">Unspecified</p>
            </div>
            <button
              onclick="showPersonalForm()"
              class="font-medium underline">
              Edit
            </button>
          </div>
        </div>
        <div class="flex flex-col gap-4 md:flex-row">
          <h6 class="w-60 text-2xl font-medium text-zinc-900">
            Login Details
          </h6>
          <form
            id="login-form"
            class="hidden max-w-2xl flex-col items-start gap-4"
            onsubmit="return validateLogin()">
            <div class="w-full">
              <label class="mb-2 block font-medium text-zinc-900" for="email">Email</label>
              <input
                class="w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900"
                type="email"
                id="email"
                name="email"
                placeholder="email@example.com"
                required />
              <p id="email-error" class="mt-1 hidden text-sm text-red-500">
                Invalid email format
              </p>
            </div>
            <div class="w-full">
              <label
                class="mb-2 block font-medium text-zinc-900"
                for="password">New Password</label>
              <input
                class="w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900"
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
                title="Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character." />
              <p id="password-error" class="mt-1 hidden text-sm text-red-500">
                Password must be at least 8 characters long, include at least
                one uppercase letter, one lowercase letter, one number, and
                one special character
              </p>
            </div>
            <div class="w-full">
              <label
                class="mb-2 block font-medium text-zinc-900"
                for="confirm-password">Confirm Password</label>
              <input
                class="w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900"
                type="password"
                id="confirm-password"
                name="confirm-password"
                placeholder="••••••••"
                required
                title="Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character." />
              <p
                id="confirm-password-error"
                class="mt-1 hidden text-sm text-red-500">
                Passwords do not match
              </p>
            </div>
            <div class="space-x-4">
              <button
                class="font-medium text-zinc-700"
                onclick="hideLoginForm()">
                Cancel
              </button>
              <button type="submit" class="font-medium underline">
                Save
              </button>
            </div>
            <p
              id="alert-error-login"
              class="hidden text-center text-red-500"></p>
          </form>
          <div
            id="login-display"
            class="flex flex-col items-start gap-4 text-zinc-900">
            <div>
              <p class="text-sm font-medium text-zinc-700">Email</p>
              <p id="user-email">Loading...</p>
            </div>
            <div>
              <p class="text-sm font-medium text-zinc-700">Password</p>
              <p>*********</p>
            </div>
            <button class="font-medium underline" onclick="showLoginForm()">
              Edit
            </button>
          </div>
        </div>
        <div class="flex flex-col gap-4 md:flex-row">
          <h6 class="w-60 text-2xl font-medium text-zinc-900">
            Address Details
          </h6>
          <form
            id="address-form"
            class="hidden max-w-2xl flex-col items-start gap-4"
            onsubmit="return validateAddress()">
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
                class="w-full rounded-lg border border-zinc-200 px-4 py-3 transition-shadow focus:outline-none focus:ring-2 focus:ring-zinc-900" />
              <p id="phone-error" class="mt-1 hidden text-sm text-red-500">
                Invalid phone number
              </p>
            </div>
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
          <div
            id="address-display"
            class="flex flex-col items-start gap-4 text-zinc-900">
            <div>
              <p class="text-sm font-medium text-zinc-700">Address</p>
              <p id="user-address">Loading...</p>
            </div>
            <div>
              <p class="text-sm font-medium text-zinc-700">Postal Code</p>
              <p id="user-postal">Loading...</p>
            </div>
            <div>
              <p class="text-sm font-medium text-zinc-700">Phone Number</p>
              <p id="user-phone">Loading...</p>
            </div>
            <button class="font-medium underline" onclick="showAddressForm()">
              Edit
            </button>
          </div>
        </div>
      </section>
      <!-- Order history tab -->
      <section id="history" class="hidden flex-col gap-8"></section>
    </div>
  </main>
  <div id="footer"></div>
  <script>
    function showAlert(message, category) {
      let alertBox;
      if (category === "personal")
        alertBox = document.getElementById("alert-error-personal");
      else if (category === "login")
        alertBox = document.getElementById("alert-error-login");
      else if (category === "address")
        alertBox = document.getElementById("alert-error-address");
      alertBox.innerText = message;
      alertBox.classList.remove("hidden");
      setTimeout(() => {
        alertBox.classList.add("hidden");
      }, 3000); // Automatically hide after 3 seconds
    }

    const showPersonalForm = () => {
      document
        .getElementById("personal-form")
        .classList.replace("hidden", "flex");
      document
        .getElementById("personal-display")
        .classList.replace("flex", "hidden");
    };
    const hidePersonalForm = () => {
      document
        .getElementById("personal-display")
        .classList.replace("hidden", "flex");
      document
        .getElementById("personal-form")
        .classList.replace("flex", "hidden");
    };
    const showLoginForm = () => {
      document
        .getElementById("login-form")
        .classList.replace("hidden", "flex");
      document
        .getElementById("login-display")
        .classList.replace("flex", "hidden");
    };
    const hideLoginForm = () => {
      document
        .getElementById("login-display")
        .classList.replace("hidden", "flex");
      document
        .getElementById("login-form")
        .classList.replace("flex", "hidden");
      document.getElementById("password").value = null;
      document.getElementById("confirm-password").value = null;
    };
    const showAddressForm = () => {
      document
        .getElementById("address-form")
        .classList.replace("hidden", "flex");
      document
        .getElementById("address-display")
        .classList.replace("flex", "hidden");
    };
    const hideAddressForm = () => {
      document
        .getElementById("address-display")
        .classList.replace("hidden", "flex");
      document
        .getElementById("address-form")
        .classList.replace("flex", "hidden");
    };

    const validatePersonal = () => {
      const firstNameInput = document.getElementById("first-name");
      const firstNameError = document.getElementById("first-name-error");
      const lastNameInput = document.getElementById("last-name");
      const lastNameError = document.getElementById("last-name-error");

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

      if (isValid) {
        const form = document.getElementById("personal-form");
        const formData = new FormData(form);
        fetch("editAccountDetails.php", {
            method: "POST",
            body: formData
          })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              hidePersonalForm();
              // Update display with new values
              document.getElementById("user-name").innerText =
                formData.get("first-name") + " " + formData.get("last-name");
              document.getElementById("user-gender").innerText =
                formData.get("gender");
            } else if (data.error) showAlert(data.error, "personal");
          });
      }
      return false;
    };

    const validateLogin = () => {
      const emailInput = document.getElementById("email");
      const emailError = document.getElementById("email-error");
      const passwordInput = document.getElementById("password");
      const passwordError = document.getElementById("password-error");
      const confirmPasswordInput =
        document.getElementById("confirm-password");
      const confirmPasswordError = document.getElementById(
        "confirm-password-error",
      );

      let isValid = true;

      if (!/^[\S+-]+@(\S+\.){1,3}\S{1,3}$/.test(emailInput.value)) {
        emailError.textContent = emailInput.validity.valueMissing ?
          "Email is required." :
          "Please enter a valid email address.";
        emailError.classList.remove("hidden");
        isValid = false;
      } else {
        emailError.classList.add("hidden");
      }

      // Password validation
      if (
        !/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/.test(
          passwordInput.value,
        )
      ) {
        passwordError.textContent = passwordInput.validity.valueMissing ?
          "Password is required." :
          "Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.";
        passwordError.classList.remove("hidden");
        isValid = false;
      } else {
        passwordError.classList.add("hidden");
      }

      // Password match validation
      if (passwordInput.value !== confirmPasswordInput.value) {
        confirmPasswordError.textContent = "Passwords do not match.";
        confirmPasswordError.classList.remove("hidden");
        isValid = false;
      } else {
        confirmPasswordError.classList.add("hidden");
      }

      if (isValid) {
        const form = document.getElementById("login-form");
        const formData = new FormData(form);
        fetch("editAccountDetails.php", {
            method: "POST",
            body: formData
          })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              hideLoginForm();
              document.getElementById("user-email").innerText =
                formData.get("email");
            } else if (data.error) showAlert(data.error, "login");
          });
      }
      return false;
    };

    const validateAddress = () => {
      const addressInput = document.getElementById("address");
      const addressError = document.getElementById("address-error");
      const postalCodeInput = document.getElementById("postal-code");
      const postalError = document.getElementById("postal-error");
      const phoneInput = document.getElementById("phone");
      const phoneError = document.getElementById("phone-error");

      let isValid = true;

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
        fetch("editAccountDetails.php", {
            method: "POST",
            body: formData
          })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              hideAddressForm();
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

    const logout = () => {
      window.location.href = "logout.php";
    };

    const fetchDetails = async () => {
      return fetch("getAccountDetails.php?details=true")
        .then((response) => response.json())
        .then((data) => {
          document.getElementById("first-name").value = data.first_name;
          document.getElementById("last-name").value = data.last_name;
          document.getElementById("user-name").innerText =
            data.first_name + " " + data.last_name;
          if (data.gender !== null) {
            document.getElementById("user-gender").innerText =
              data.gender === 1 ? "Male" : "Female";
            if (data.gender === 1) {
              document.getElementById("gender-male").checked = true;
            } else {
              document.getElementById("gender-female").checked = true;
            }
            document.getElementById("gender-unspecified").checked = false;
          }
          document.getElementById("user-email").innerText = data.email;
          document.getElementById("email").value = data.email;
          document.getElementById("user-address").innerText = data.address ?
            data.address :
            "None";
          if (data.address)
            document.getElementById("address").value = data.address;
          document.getElementById("user-phone").innerText = data.phone_number ?
            data.phone_number :
            "None";
          if (data.phone_number)
            document.getElementById("phone").value = data.phone_number;
          document.getElementById("user-postal").innerText = data.postal_code ?
            data.postal_code :
            "None";
          if (data.postal_code)
            document.getElementById("postal-code").value = data.postal_code;
        });
    };

    const fetchOrders = async () => {
      let ordersHtml = "";
      return fetch("getAccountDetails.php")
        .then((response) => response.json())
        .then((data) => {
          data.forEach((order, index) => {
            let images = "";
            const urls = order.image_urls.split("|");
            urls.forEach((url) => {
              images += `<div class="size-24 bg-zinc-200 flex-shrink-0 rounded-lg">
                          <img src="${url}" alt="order item" class="size-full object-cover rounded-lg" />
                        </div>`;
            });
            ordersHtml += `<div class="flex flex-wrap gap-8">
                            <div class="flex-grow w-full">
                              <div class="flex justify-between flex-wrap gap-6 items-start mb-6">
                                <div>
                                  <h6 class="mb-1 text-2xl font-medium text-zinc-900">
                                    ${new Date(order.date).toLocaleDateString("en-GB", { day: "2-digit", month: "short", year: "numeric" })} | $${order.total}
                                  </h6>
                                  <p class="text-zinc-700">Order number: ${order.id}</p>
                                </div>
                                <a
                                  class="flex min-w-fit items-center justify-center rounded-full border border-zinc-200 px-5 py-2 font-medium transition-colors hover:bg-zinc-100"
                                  href="manageOrder.php?no=${order.id}"
                                >
                                  View or Edit
                                </a>
                              </div>
                              <div class="flex w-full gap-3 overflow-x-scroll">
                                ${images}
                              </div>
                            </div>
                          </div>`;
            if (index !== data.length - 1)
              ordersHtml += `<div class="h-px bg-zinc-200"></div>`;
          });
          if (ordersHtml === "")
            ordersHtml = `<p class="text-zinc-700">You have no orders yet.</p>`;
          document.getElementById("history").innerHTML = ordersHtml;
        });
    };

    const showDetails = (show) => {
      const details = document.getElementById("details");
      const historyView = document.getElementById("history");
      const detailsTab = document.getElementById("details-tab");
      const historyTab = document.getElementById("history-tab");
      const fadeContainer = document.getElementById("fade-container");
      if (show) {
        fetchDetails().then(() => {
          fadeContainer.classList.replace("opacity-100", "opacity-0");
          setTimeout(() => {
            fadeContainer.classList.replace("opacity-0", "opacity-100");
            details.classList.replace("hidden", "flex");
            historyView.classList.replace("flex", "hidden");
          }, 300);

          detailsTab.classList.replace(
            "border-transparent",
            "border-zinc-900",
          );
          detailsTab.classList.replace("text-zinc-500", "text-zinc-900");
          historyTab.classList.replace(
            "border-zinc-900",
            "border-transparent",
          );
          historyTab.classList.replace("text-zinc-900", "text-zinc-500");
        });
      } else {
        fetchOrders().then(() => {
          fadeContainer.classList.replace("opacity-100", "opacity-0");
          setTimeout(() => {
            fadeContainer.classList.replace("opacity-0", "opacity-100");
            historyView.classList.replace("hidden", "flex");
            details.classList.replace("flex", "hidden");
          }, 300);

          historyTab.classList.replace(
            "border-transparent",
            "border-zinc-900",
          );
          historyTab.classList.replace("text-zinc-500", "text-zinc-900");
          detailsTab.classList.replace(
            "border-zinc-900",
            "border-transparent",
          );
          detailsTab.classList.replace("text-zinc-900", "text-zinc-500");
        });
      }
    };

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const history = urlParams.get("history");
    if (history) {
      showDetails(false);
    } else {
      showDetails(true);
    }

    const onTabClick = (orderHistoryTab) => {
      let url = new URL(window.location.href);
      if (orderHistoryTab) {
        url.searchParams.set("history", "true");
        window.history.replaceState(window.history.state, "", url.href);
        showDetails(false);
      } else {
        url.searchParams.delete("history");
        window.history.replaceState(window.history.state, "", url.href);
        showDetails(true);
      }
    };
  </script>
</body>

</html>