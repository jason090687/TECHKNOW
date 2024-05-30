<?php
include "db.php";

$customer_id = "";
$customer_name = "";
$email = "";
$shipping_address = "";
$contact_number = "";
$password = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email']; // added this line
    $shipping_address = $_POST['shipping_address'];
    $contact_number = $_POST['contact_number'];
    $password = $_POST['password'];

    do {
        if (empty($customer_id) || empty($customer_name) || empty($email) || empty($shipping_address) || empty($contact_number) || empty($password)) {
            $errorMessage = "All the fields are required";
            break;
        }

        // add new customer to database
        $sql = "INSERT INTO customers (customer_id, customer_name, email, shipping_address, contact_number, password) VALUES ('$customer_id', '$customer_name', '$email', '$shipping_address', '$contact_number', '$password')";

        if ($connect->query($sql) === TRUE) {
            $customer_id = "";
            $customer_name = "";
            $email = "";
            $shipping_address = "";
            $contact_number = "";
            $password = "";

            $successMessage = "Customer added Successfully";
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . $connect->error;
        }

        header("location: ./dashboard.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChiChart</title>
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <h2>New Customer</h2>
    <form method="POST" action="">
        <div class="row mb-3">
            <label class="col-3 col-form-label">Customer ID</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="customer_id" value="<?php echo htmlspecialchars($customer_id); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-3 col-form-label">Customer Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-3 col-form-label">Shipping Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="shipping_address" value="<?php echo htmlspecialchars($shipping_address); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-3 col-form-label">Contact Number</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-3 col-form-label">Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars($password); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6 offset-sm-3">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a class="btn btn-outline-primary" href="/dashboard.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>
