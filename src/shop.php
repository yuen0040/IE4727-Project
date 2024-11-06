<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require 'db.php';

// Get segment and category from query parameters
$segment = isset($_GET['segment']) ? $_GET['segment'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 4;

// Fetch random sale items with sale_price not NULL
if ($segment == 'sale') {
    $sql_random_sales = "
    SELECT p.product_id, p.name, p.category, p.segment, p.price, p.sale_price, i.image_url
    FROM products p
    JOIN images i ON p.product_id = i.product_id
    WHERE p.sale_price IS NOT NULL AND p.category = ?
    AND i.image_url IS NOT NULL
    GROUP BY p.product_id
    LIMIT ?, ?;
";
    $stmt_random_sales = $conn->prepare($sql_random_sales);
    $stmt_random_sales->bind_param('sss', $category, $offset, $limit);
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
            echo "<div class='aspect-square rounded-lg bg-zinc-200 overflow-hidden'>
                    <img src='{$row['image_url']}' alt='{$row['name']}' class='size-full object-cover group-hover:scale-105 transition-transform duration-300'/>
                </div>";
            echo "<div class='text-zinc-900 w-full'>";
            echo '<h3 class="font-medium mb-1 text-lg line-clamp-1">' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="text-zinc-700">' . ucfirst($category) . '</p>';
            echo "</div>";
            echo '<p class="text-lg">';
            echo "<span class='mr-2 font-medium text-red-500'>$price</span>";
            echo "<span class='text-zinc-500 line-through'>$salePrice</span>";
            echo '</p>';
            echo '</div>';
            echo '</a>';
        }
    }
    $stmt_random_sales->close();
} else if ($category == 'all') {
    $sql_all = "
    SELECT p.product_id, p.segment, p.name, p.category, p.price, p.sale_price, i.image_url 
    FROM products AS p
    LEFT JOIN images AS i ON p.product_id = i.product_id
    WHERE p.segment = ?
    GROUP BY p.product_id
    LIMIT ?, ?;
";
    // Prepare and execute the statement
    $stmt_all = $conn->prepare($sql_all);
    $stmt_all->bind_param('sss', $segment, $offset, $limit); // Bind parameters
    $stmt_all->execute();
    $result_all = $stmt_all->get_result();

    if ($result_all->num_rows > 0) {
        while ($row = $result_all->fetch_assoc()) {
            // Convert segment and category to lowercase for CSS classes if needed
            $segment = strtolower($row['segment']);
            $category = strtolower($row['category']);

            // Determine the price format, applying sale price if available
            $price = "$" . $row["price"];
            $salePrice = $row["sale_price"] ? "$" . $row["sale_price"] : "";

            // HTML output for each product
            echo '<a class="group min-w-48" href="product.html?name=' . urlencode($row['name']) . '">';
            echo '<div class="flex flex-col gap-3">';
            echo "<div class='aspect-square rounded-lg bg-zinc-200 overflow-hidden'>
                    <img src='{$row['image_url']}' alt='{$row['name']}' class='size-full object-cover group-hover:scale-105 transition-transform duration-300'/>
                </div>";
            echo "<div class='text-zinc-900 w-full'>";
            echo '<h3 class="font-medium mb-1 text-lg line-clamp-1">' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="text-zinc-700">' . ucfirst($category) . '</p>';
            echo "</div>";
            echo '<p class="text-lg">';
            if (!empty($salePrice)) {
                echo "<span class='font-medium mr-2 text-red-500'>$price</span>";
                echo "<span class='text-zinc-500 line-through'>$salePrice</span>";
            } else {
                echo "<span class='font-medium'>$price</span>";
            }
            echo '</p>';
            echo '</div>';
            echo '</a>';
        }
    }
    $stmt_all->close();
}
// Prepare the SQL query
else {
    $sql = "
    SELECT p.product_id, p.segment, p.name, p.category, p.price, p.sale_price, i.image_url 
    FROM products AS p
    LEFT JOIN images AS i ON p.product_id = i.product_id
    WHERE p.segment = ? AND p.category = ?
    GROUP BY p.product_id
    LIMIT ?, ?;
";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $segment, $category, $offset, $limit); // Bind parameters
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Convert segment and category to lowercase for CSS classes if needed
            $segment = strtolower($row['segment']);
            $category = strtolower($row['category']);

            // Determine the price format, applying sale price if available
            $price = "$" . $row["price"];
            $salePrice = $row["sale_price"] ? "$" . $row["sale_price"] : "";

            // HTML output for each product
            echo '<a class="group min-w-48" href="product.html?name=' . urlencode($row['name']) . '">';
            echo '<div class="flex flex-col gap-3">';
            echo "<div class='aspect-square rounded-lg bg-zinc-200 overflow-hidden'>
                    <img src='{$row['image_url']}' alt='{$row['name']}' class='size-full object-cover group-hover:scale-105 transition-transform duration-300'/>
                </div>";
            echo "<div class='text-zinc-900 w-full'>";
            echo '<h3 class="font-medium mb-1 text-lg line-clamp-1">' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="text-zinc-700">' . ucfirst($category) . '</p>';
            echo "</div>";
            echo '<p class="text-lg">';
            if (!empty($salePrice)) {
                echo "<span class='font-medium mr-2 text-red-500'>$price</span>";
                echo "<span class='text-zinc-500 line-through'>$salePrice</span>";
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

$conn->close();
