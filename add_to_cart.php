<?php
session_start();
include("db.php");

function add_to_cart($product_id) {
    global $connect;

    // Query to fetch product details
    $query = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // If the product is already in the cart, increment the quantity
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            // Add new product to the cart
            $_SESSION['cart'][$product_id] = [
                'product_name' => $product['product_name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
    }
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    add_to_cart($product_id);
    unset($_SESSION['wishlist'][$product_id]);
}
header('Location: wishlist.php');
exit;
?>
