<?php
session_start();
include("../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['request'])) {
        if ($_POST['request'] == "addToCart") {
            // Validate and sanitize the input
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];

            // Check if the product already exists in the cart
            $product_exists = false;
            if (!empty($_SESSION['products'])) {
                foreach ($_SESSION['products'] as $product) {
                    if ($product['product_id'] == $product_id) {
                        $product_exists = true;
                        break;
                    }
                }
            }

            // Add the product to the cart if it doesn't already exist
            if (!$product_exists) {
                $_SESSION['products'][] = array('product_id' => $product_id, 'product_name' => $product_name, 'price' => $price);
                $return = array('success' => true, 'message' => 'Product added to cart');
            } else {
                $return = array('success' => false, 'message' => 'Product already exists in cart');
            }

            echo json_encode($return);
        } elseif ($_POST['request'] == "placeOrder") {
            // Check if there are products in the cart
            if (!empty($_SESSION['products'])) {
                $total = 0;
                foreach ($_SESSION['products'] as $product) {
                    $total += $product['price'];
                }

                $today = date('Y-m-d');
                $order_query = "INSERT INTO orders (customer_id, order_date, total_amount, status) VALUES ('1', '$today', '$total', 'To receive')";

                if ($connect->query($order_query) === TRUE) {
                    $return = array('success' => true, 'message' => 'Order placed successfully');
                } else {
                    $return = array('success' => false, 'message' => 'Failed to place order');
                }
            } else {
                $return = array('success' => false, 'message' => 'No products in cart');
            }

            echo json_encode($return);
        }
    }
}
?>
