<?php
include 'db.php';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $sql = "DELETE FROM orders WHERE order_id='$order_id'";

    if ($connect->query($sql) === TRUE) {
        echo "Order deleted successfully";
    } else {
        echo "Error deleting order: " . $connect->error;
    }

    $connect->close();
    header("Location: orders.php");
    exit();
} else {
    echo "Invalid request";
    exit();
}
?>
