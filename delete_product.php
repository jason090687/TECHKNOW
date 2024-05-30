<?php
include 'db.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sql = "DELETE FROM products WHERE product_id='$product_id'";

    if ($connect->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $connect->error;
    }

    $connect->close();
    header("Location: products.php");
    exit();
} else {
    echo "Invalid request";
    exit();
}
?>
