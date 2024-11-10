<?php
require 'db.php';
header('Content-Type: application/json');

$searchTerm = isset($_GET['term']) ? $_GET['term'] : '';

if (strlen($searchTerm) >= 2) {
    $sql = "
        SELECT 
            p.product_id,
            p.name,
            p.description,
            p.price,
            p.sale_price,
            p.category,
            p.segment,
            GROUP_CONCAT(DISTINCT i.image_url ORDER BY i.image_id SEPARATOR '|' LIMIT 1) AS image_url,
            GROUP_CONCAT(DISTINCT s.size ORDER BY s.size_id SEPARATOR ', ') as available_sizes
        FROM 
            products p
        LEFT JOIN 
            images i ON p.product_id = i.product_id
        LEFT JOIN 
            sizes s ON p.product_id = s.product_id
        WHERE 
            p.name LIKE ?
        GROUP BY 
            p.product_id
        LIMIT 10
    ";

    $stmt = $conn->prepare($sql);
    $searchPattern = "%$searchTerm%";
    $stmt->bind_param('s', $searchPattern);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = [
                'product_id' => $row['product_id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => "$" . $row['price'],
                'sale_price' => $row['sale_price'] ? "$" . $row['sale_price'] : null,
                'category' => ucfirst($row['category']),
                'segment' => ucfirst($row['segment']),
                'image_url' => $row['image_url'] ? explode('|', $row['image_url'])[0] : null,
                'available_sizes' => $row['available_sizes']
            ];
        }
        echo json_encode($products);
    } else {
        echo json_encode([]);
    }
    $stmt->close();
} else {
    echo json_encode([]);
}
$conn->close();
?>