<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require 'db.php';

// Get segment and category from query parameters
$segment = isset($_GET['segment']) ? $_GET['segment'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Prepare the SQL query
$sql = "
    SELECT p.product_id, p.segment, p.name, p.category, p.price, p.sale_price, i.image_url 
    FROM products AS p
    LEFT JOIN images AS i ON p.product_id = i.product_id
    WHERE p.segment = ? AND p.category = ?
    GROUP BY p.product_id
";

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $segment, $category); // Bind parameters
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
        echo '<h3 class="mt-4 font-medium">' . htmlspecialchars($row['name']) . '</h3>';
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
$conn->close();
