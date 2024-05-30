<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $shipping_address = $_POST['shipping_address'];
    $contact_number = $_POST['contact_number'];
    $password = $_POST['password'];

    $sql = "UPDATE customers SET customer_name='$customer_name', email='$email', shipping_address='$shipping_address', contact_number='$contact_number', password='$password' WHERE customer_id='$customer_id'";

    if ($connect->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $connect->error;
    }

    $connect->close();
    header("Location: dashboard.php");
    exit();
} else {
    if (isset($_GET['customer_id'])) {
        $customer_id = $_GET['customer_id'];
        $sql = "SELECT * FROM customers WHERE customer_id='$customer_id'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Record not found";
        }
    }
    $connect->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="../style/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Customer</h2>
        <form action="update_config.php" method="post">
            <input type="hidden" name="customer_id" value="<?php echo $row['customer_id']; ?>">
            <div class="form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $row['customer_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="shipping_address">Shipping Address:</label>
                <input type="text" class="form-control" id="shipping_address" name="shipping_address" value="<?php echo $row['shipping_address']; ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $row['contact_number']; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
