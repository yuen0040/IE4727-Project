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

            echo '<a href="product.html?name=' . urlencode($row['name']) . '">';
            echo '<div class="transform rounded-lg bg-white p-4 shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">';
            echo '<div class="h-48 rounded bg-gray-300" style="background-image: url(\'' . htmlspecialchars($row['image_url']) . '\'); background-size: cover; background-position: center;"></div>';
            echo '<h3 class="mt-4 font-medium">' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="text-gray-500">' . ucfirst($category) . '</p>';
            echo '<div class="mt-2 flex items-center space-x-2">';
            echo "<span class='font-bold text-red-500'>$salePrice</span>";
            echo "<span class='text-gray-400 line-through'>$price</span>";
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }
    }
    $stmt_random_sales->close();
}

else if ($category='all') {
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
            echo '<a href="product.html?name=' . urlencode($row['name']) . '">';
            echo '<div class="transform rounded-lg bg-white p-4 shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">';
            echo '<div class="h-48 rounded bg-gray-300" style="background-image: url(\'' . $row['image_url'] . '\'); background-size: cover; background-position: center;"></div>';
            echo '<h3 class="mt-4 font-medium overflow-ellipsis overflow-hidden whitespace-nowrap w-48">' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="text-gray-500">' . ucfirst($category) . '</p>';
            echo '<p class="mt-2">';
            if (!empty($salePrice)) {
                echo "<span class='font-bold text-red-500'>$price</span>";
                echo "<span class='ml-2 text-gray-500 line-through'>$salePrice</span>";
            } else {
                echo "<span class='font-bold'>$price</span>";
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
            echo '<a href="product.html?name=' . urlencode($row['name']) . '">';
            echo '<div class="transform rounded-lg bg-white p-4 shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">';
            echo '<div class="h-48 rounded bg-gray-300" style="background-image: url(\'' . $row['image_url'] . '\'); background-size: cover; background-position: center;"></div>';
            echo '<h3 class="mt-4 font-medium overflow-ellipsis overflow-hidden whitespace-nowrap w-48">' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="text-gray-500">' . ucfirst($category) . '</p>';
            echo '<p class="mt-2">';
            if (!empty($salePrice)) {
                echo "<span class='font-bold text-red-500'>$price</span>";
                echo "<span class='ml-2 text-gray-500 line-through'>$salePrice</span>";
            } else {
                echo "<span class='font-bold'>$price</span>";
            }
            echo '</p>';
            echo '</div>';
            echo '</a>';
        }
    }
    $stmt->close();
}

$conn->close();
