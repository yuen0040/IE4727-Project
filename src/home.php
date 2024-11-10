<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require 'db.php';

// Get segment and category from query parameters
$section = isset($_GET['section']) ? $_GET['section'] : '';

// SQL query to get the latest 5 products by created_at and 3 random sale items with sale_price not NULL
$sql = "
    SELECT p.product_id, p.name, p.category, p.segment, p.price, p.sale_price, i.image_url
    FROM products p
    JOIN images i ON p.product_id = i.product_id
    WHERE i.image_url IS NOT NULL
    AND p.created_at IS NOT NULL
    GROUP BY p.product_id
    ORDER BY p.created_at DESC
    LIMIT 6;
";
$stmt = $conn->prepare($sql); // Prepare statement
$stmt->execute();
$result = $stmt->get_result();

// Output products from "New Section"
if ($section == 'new-section') {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Prepare variables for easy access
            $segment = strtolower($row['segment']);
            $category = strtolower($row['category']);
            $price = "$" . $row["price"];
            $salePrice = $row["sale_price"] ? "$" . $row["sale_price"] : "";

            // HTML output for each product
            echo '<a class="group min-w-48" href="product.html?name=' . urlencode($row['name']) . '">';
            echo '<div class="flex flex-col gap-3">';
            echo "<div class='aspect-square rounded-xl bg-zinc-200 overflow-hidden'>
                    <img src='{$row['image_url']}' alt='{$row['name']}' class='size-full object-cover group-hover:scale-105 transition-transform duration-300'/>
                </div>";
            echo "<div class='text-zinc-900 w-full'>";
            echo '<h3 class="font-medium mb-1 text-lg line-clamp-1">' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="text-zinc-700">' . ucfirst($category) . '</p>';
            echo "</div>";
            echo '<p class="text-lg">';
            if (!empty($salePrice)) {
                echo "<span class='font-medium mr-2 text-red-500'>$salePrice</span>";
                echo "<span class='text-zinc-500 line-through'>$price</span>";
            } else {
                echo "<span class='font-medium'>$price</span>";
            }
            echo '</p>';
            echo '</div>';
            echo '</a>';
        }
    }
    $stmt->close();
}

// Fetch random sale items with sale_price not NULL, limit to 4
if ($section == 'sales-section') {
    $sql_random_sales = "
    SELECT p.product_id, p.name, p.category, p.segment, p.price, p.sale_price, i.image_url
    FROM products p
    JOIN images i ON p.product_id = i.product_id
    WHERE p.sale_price IS NOT NULL
    AND i.image_url IS NOT NULL
    GROUP BY p.product_id
    ORDER BY RAND()
    LIMIT 4;
";
    $stmt_random_sales = $conn->prepare($sql_random_sales);
    $stmt_random_sales->execute();
    $result_random_sales = $stmt_random_sales->get_result();

    // Output sale products
    if ($result_random_sales->num_rows > 0) {
        while ($row = $result_random_sales->fetch_assoc()) {
            $segment = strtolower($row['segment']);
            $category = strtolower($row['category']);
            $price = "$" . $row["price"];
            $salePrice = "$" . $row["sale_price"];

            echo '<a class="group min-w-48" href="product.html?name=' . urlencode($row['name']) . '">';
            echo '<div class="flex flex-col gap-3">';
            echo "<div class='aspect-square rounded-xl bg-zinc-200 overflow-hidden'>
                    <img src='{$row['image_url']}' alt='{$row['name']}' class='size-full object-cover group-hover:scale-105 transition-transform duration-300'/>
                </div>";
            echo "<div class='text-zinc-900 w-full'>";
            echo '<h3 class="font-medium mb-1 text-lg line-clamp-1">' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="text-zinc-700">' . ucfirst($category) . '</p>';
            echo "</div>";
            echo '<p class="text-lg">';
            echo "<span class='mr-2 font-medium text-red-500'>$salePrice</span>";
            echo "<span class='text-zinc-500 line-through'>$price</span>";
            echo '</p>';
            echo '</div>';
            echo '</a>';
        }
    }
    $stmt_random_sales->close();
}

$conn->close();
