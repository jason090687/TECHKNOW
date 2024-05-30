<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
    $total_amount = $_POST['total_amount'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET customer_id='$customer_id', order_date='$order_date', total_amount='$total_amount', status='$status' WHERE order_id='$order_id'";

    if ($connect->query($sql) === TRUE) {
        echo "Order updated successfully";
    } else {
        echo "Error updating order: " . $connect->error;
    }

    $connect->close();
    header("Location: orders.php");
    exit();
} else {
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $sql = "SELECT * FROM orders WHERE order_id='$order_id'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Order not found";
            exit();
        }
    } else {
        echo "Invalid request";
        exit();
    }
    $connect->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="stylesheet" href="../style/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Order</h2>
        <form action="edit_order.php" method="post">
            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer ID:</label>
                <input type="text" class="form-control" id="customer_id" name="customer_id" value="<?php echo $row['customer_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="order_date" class="form-label">Order Date:</label>
                <input type="date" class="form-control" id="order_date" name="order_date" value="<?php echo $row['order_date']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="total_amount" class="form-label">Total Amount:</label>
                <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" value="<?php echo $row['total_amount']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo $row['status']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>
</body>
</html>
