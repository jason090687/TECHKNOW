<?php
include "db.php";

$customer_id = $_GET['id'];
$sql = "DELETE FROM customers WHERE customer_id = $customer_id";

if ($connect->query($sql) === TRUE) {
    header("Location: dashboard.php");
} else {
    echo "Error deleting record: " . $connect->error;
}

$connect->close();
?>
