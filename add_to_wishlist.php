<?php
session_start();

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Check if the wishlist array is already set in the session
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = [];
    }

    // Add the product to the wishlist
    $_SESSION['wishlist'][$product_id] = [
        'product_name' => $product_name,
        'price' => $price
    ];

    echo json_encode(['status' => 'success', 'message' => 'Product added to wishlist']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>