<?php
require 'db.php';

// Get parameters from query string
$segment = isset($_GET['segment']) ? $_GET['segment'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 4;
$minPrice = isset($_GET['minPrice']) ? (float)$_GET['minPrice'] : 0;
$maxPrice = isset($_GET['maxPrice']) ? (float)$_GET['maxPrice'] : 500;
$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'default';

// Set the sort clause based on price sorting
$sortClause = match ($sortOrder) {
    'price_asc' => 'ORDER BY COALESCE(p.sale_price, p.price) ASC',
    'price_desc' => 'ORDER BY COALESCE(p.sale_price, p.price) DESC',
    'sale' => 'AND p.sale_price IS NOT NULL ORDER BY p.product_id',
    default => 'ORDER BY p.product_id'
};

// Price filtering clause using COALESCE
$priceClause = "AND COALESCE(p.sale_price, p.price) BETWEEN ? AND ?";

// Construct SQL based on whether we're showing sale items or regular products
if ($segment == 'sale') {
    if ($category == 'all') {
        $sql = "
            SELECT p.product_id, p.name, p.category, p.segment, p.price, p.sale_price, i.image_url
            FROM products p
            JOIN images i ON p.product_id = i.product_id
            WHERE p.sale_price IS NOT NULL
            AND i.image_url IS NOT NULL
            $priceClause
            GROUP BY p.product_id
            $sortClause
            LIMIT ?, ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ddii', $minPrice, $maxPrice, $offset, $limit);
    } else {
        $sql = "
            SELECT p.product_id, p.name, p.category, p.segment, p.price, p.sale_price, i.image_url
            FROM products p
            JOIN images i ON p.product_id = i.product_id
            WHERE p.sale_price IS NOT NULL 
            AND p.category = ?
            AND i.image_url IS NOT NULL
            $priceClause
            GROUP BY p.product_id
            $sortClause
            LIMIT ?, ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sddii', $category, $minPrice, $maxPrice, $offset, $limit);
    }
} else {
    if ($category == 'all') {
        $sql = "
            SELECT p.product_id, p.name, p.category, p.segment, p.price, p.sale_price, i.image_url
            FROM products p
            LEFT JOIN images i ON p.product_id = i.product_id
            WHERE p.segment = ?
            $priceClause
            " . ($sortOrder === 'sale' ? "AND p.sale_price IS NOT NULL" : "") . "
            GROUP BY p.product_id
            " . ($sortOrder === 'sale' ? "ORDER BY p.product_id" : $sortClause) . "
            LIMIT ?, ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sddii', $segment, $minPrice, $maxPrice, $offset, $limit);
    } else {
        $sql = "
            SELECT p.product_id, p.name, p.category, p.segment, p.price, p.sale_price, i.image_url
            FROM products p
            LEFT JOIN images i ON p.product_id = i.product_id
            WHERE p.segment = ?
            AND p.category = ?
            $priceClause
            " . ($sortOrder === 'sale' ? "AND p.sale_price IS NOT NULL" : "") . "
            GROUP BY p.product_id
            " . ($sortOrder === 'sale' ? "ORDER BY p.product_id" : $sortClause) . "
            LIMIT ?, ?
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssddii', $segment, $category, $minPrice, $maxPrice, $offset, $limit);
    }
}

// // Debug output
// echo "<!-- 
// Debug Info:
//     Segment: $segment
//     Category: $category
//     Offset: $offset
//     Limit: $limit
//     Min Price: $minPrice
//     Max Price: $maxPrice
//     Sort Order: $sortOrder
//     SQL: $sql
// -->\n";

$stmt->execute();
$result = $stmt->get_result();

// Output products
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $shoeSegment = strtolower($row['segment']);
        $category = strtolower($row['category']);
        $price = "$" . $row["price"];
        $salePrice = $row["sale_price"] ? "$" . $row["sale_price"] : "";

        echo '<a class="group min-w-48" href="product.html?name=' . urlencode($row['name']) . '">';
        echo '<div class="flex flex-col gap-3">';
        echo "<div class='aspect-square rounded-xl bg-zinc-200 overflow-hidden'>
                <img src='{$row['image_url']}' alt='{$row['name']}' class='size-full object-cover group-hover:scale-105 transition-transform duration-300'/>
            </div>";
        echo "<div class='text-zinc-900 w-full'>";
        echo '<h3 class="font-medium mb-1 text-lg line-clamp-1">' . htmlspecialchars($row['name']) . '</h3>';

        // Show category for non-sale items, segment and category for sale items
        if ($segment == 'sale') {
            echo '<span class="text-zinc-700">' . ucfirst($shoeSegment) . " " . ucfirst($category) . '</span>';
        } else {
            echo '<p class="text-zinc-700">' . ucfirst($category) . '</p>';
        }

        echo "</div>";
        echo '<p class="text-lg">';
        if ($segment == 'sale' || !empty($salePrice)) {
            echo "<span class='mr-2 font-medium text-red-500'>" . $salePrice . "</span>";
            echo "<span class='text-zinc-500 line-through'>" . $price . "</span>";
        } else {
            echo "<span class='font-medium'>$price</span>";
        }
        echo '</p>';
        echo '</div>';
        echo '</a>';
    }
}

$stmt->close();
$conn->close();
