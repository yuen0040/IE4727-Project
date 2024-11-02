<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require 'db.php';
session_start();

// Check if the product name is passed as a query parameter
$productName = isset($_GET['name']) ? $_GET['name'] : '';

if (!empty($productName)) {
    // SQL query to retrieve product details, images (limited to 4), and sizes
    $sql = "
        SELECT 
            p.product_id,
            p.description,
            p.details,
            p.price,
            p.sale_price,
            p.category,
            p.segment,
            GROUP_CONCAT(DISTINCT i.image_url ORDER BY i.image_id SEPARATOR '|' LIMIT 4) AS image_urls,
            s.size_id,
            s.stock,
            s.size
        FROM 
            products p
        LEFT JOIN 
            images i ON p.product_id = i.product_id
        LEFT JOIN 
            sizes s ON p.product_id = s.product_id
        WHERE 
            p.name = ?
        GROUP BY 
            s.size_id;
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $productName); // Bind the product name to the query
    $stmt->execute();
    $result = $stmt->get_result();

    $productData = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Format the product data for response
            if (empty($productData)) {
                $productData = [
                    'product_id' => $row['product_id'],
                    'description' => $row['description'],
                    'details' => $row['details'],
                    'price' => "$" . $row['price'],
                    'sale_price' => $row['sale_price'] ? "$" . $row['sale_price'] : null,
                    'category' => ucfirst($row['category']),
                    'segment' => ucfirst($row['segment']),
                    'images' => explode('|', $row['image_urls']),
                    'sizes' => []
                ];
            }

            // Add each size option to the sizes array
            $productData['sizes'][] = [
                'size_id' => $row['size_id'],
                'stock' => $row['stock'],
                'size' => $row['size']
            ];
        }

        // Output JSON encoded product data
        header('Content-Type: application/json');
        echo json_encode($productData);
    } else {
        // No product found
        echo json_encode(['error' => 'Product not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'No product name specified']);
}

$conn->close();
?>
