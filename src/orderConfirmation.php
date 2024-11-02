<?php
unset($_SESSION['checkout']);
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header("Location: home.html");
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
  <title>Order Success</title>
</head>

<body>
  <main class="mx-auto w-full max-w-[1400px] p-4 md:p-12">
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
        <div class="flex w-full gap-8">
          <div class="aspect-square size-32 bg-neutral-200 md:size-64"></div>
          <div class="flex w-full flex-col gap-6">
            <div>
              <a class="text-2xl font-medium">Product Name</a>
              <p class="text-lg font-medium">$120.00</p>
            </div>
            <div class="text-zinc-700">
              <p>Size: US9</p>
              <p>Colour: White</p>
              <p>Quantity: 1</p>
            </div>
          </div>
        </div>
      </section>
      <section class="flex w-full flex-col gap-8 lg:max-w-80">
        <h6 class="text-2xl font-medium">Order Details</h6>
        <div class="text-zinc-700">
          <p class="mb-1">Order Date: 24 Sep 2024</p>
          <p>Order Number: ASG07292703</p>
        </div>

        <div class="h-px bg-zinc-200"></div>

        <div class="text-zinc-700">
          <h6 class="mb-6 text-2xl font-medium text-zinc-900">Delivery</h6>
          <div class="flex flex-col gap-1">
            <p>Lee Tuck Hua</p>
            <p>Blk 224 Hougang Ave 1</p>
            <p>Singapore 540248</p>
            <p>+6592819188</p>
          </div>
        </div>

        <div class="h-px bg-zinc-200"></div>

        <div>
          <h6 class="mb-6 text-2xl font-medium text-zinc-900">Totals</h6>
          <div class="flex flex-col gap-1">
            <div class="flex w-full justify-between text-zinc-700">
              <p>Subtotal</p>
              <p>$130.00</p>
            </div>
            <div class="flex w-full justify-between text-zinc-700">
              <p>Delivery</p>
              <p>$10.00</p>
            </div>
            <div class="flex w-full justify-between font-medium">
              <p>Total</p>
              <p>$140.00</p>
            </div>
          </div>
        </div>

        <button
          class="flex w-full items-center justify-center rounded-full border border-zinc-200 px-5 py-2 font-medium transition-colors hover:bg-zinc-100">
          Manage Order
        </button>
      </section>
    </div>
  </main>
</body>

</html>