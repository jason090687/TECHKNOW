<?php
session_start();
include("config.php");

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch customer data from the database
$customer_id = $_SESSION['customer_id'];
$query = "SELECT * FROM customers WHERE customer_id = $customer_id";
$result = $connect->query($query);

if ($result->num_rows > 0) {
    $customer = $result->fetch_assoc();
} else {
    // Redirect if customer data is not found
    header("Location: index.php");
    exit();
}

// Fetch order history from the database
$orderQuery = "SELECT * FROM orders WHERE customer_id = $customer_id";
$orderResult = $connect->query($orderQuery);
$orderHistory = [];

if ($orderResult->num_rows > 0) {
    while ($row = $orderResult->fetch_assoc()) {
        $orderHistory[] = $row;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Update customer information in the database
    $updateQuery = "UPDATE customers SET customer_name='$name', email='$email', shipping_address='$address', contact_number='$phone' WHERE customer_id=$customer_id";
    $updateResult = $connect->query($updateQuery);

    if ($updateResult) {
        // Refresh the customer data after the update
        $customer['customer_name'] = $name;
        $customer['email'] = $email;
        $customer['shipping_address'] = $address;
        $customer['contact_number'] = $phone;

        // Redirect to account information section with success message
        header("Location: profile.php#account-info");
        exit();
    } else {
        // Handle update error
        $errorMessage = "Failed to update account information. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- The above 3 meta tags must come first in the head; any other head content must come after these tags -->

  <title>ChicHart - Online Shop</title>

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

  <!-- Bootstrap -->
  <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

  <!-- Slick -->
  <link type="text/css" rel="stylesheet" href="css/slick.css"/>
  <link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

  <!-- nouislider -->
  <link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="css/font-awesome.min.css">

  <!-- Custom stylesheet -->
  <link type="text/css" rel="stylesheet" href="css/style.css"/>

  <link type="text/css" rel="stylesheet" href="css/profile.css"/>

</head>
<body>
 <?php include('header.php');?>

  <div class="container">
    <h1 class="text-center">My Account</h1><br><br>

    <div id="account-info" class="account-info bg-light p-4">
      <h2 class="mb-4">Account Information</h2><br>
      <?php if (isset($errorMessage)): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
      <?php endif; ?>
      <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Account information updated successfully.</div>
      <?php endif; ?>
      <p><strong>Name:</strong> <span id="display-name"><?php echo isset($customer['customer_name']) ? $customer['customer_name'] : ''; ?></span></p>
      <p><strong>Email:</strong> <span id="display-email"><?php echo isset($customer['email']) ? $customer['email'] : ''; ?></span></p>
      <p><strong>Address:</strong> <span id="display-address"><?php echo isset($customer['shipping_address']) ? $customer['shipping_address'] : ''; ?></span></p>
      <p><strong>Phone:</strong> <span id="display-phone"><?php echo isset($customer['contact_number']) ? $customer['contact_number'] : ''; ?></span></p>
    </div><br>

    <div class="order-history bg-light p-4">
      <h2 class="mb-4">Order History</h2><br>
      <?php if (!empty($orderHistory)): ?>
        <table class="table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Order Date</th>
              <th>Total Amount</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orderHistory as $order): ?>
              <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['total_amount']; ?></td>
                <td><?php echo $order['status']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>You have no previous orders.</p>
      <?php endif; ?>
    </div><br>

    <div class="settings bg-light p-4">
      <h2 class="mb-4">Account Settings</h2><br>
      <form id="accountSettingsForm" method="POST">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo isset($customer['customer_name']) ? $customer['customer_name'] : ''; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo isset($customer['email']) ? $customer['email'] : ''; ?>">
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" value="<?php echo isset($customer['shipping_address']) ? $customer['shipping_address'] : ''; ?>">
        </div>
        <div class="form-group">
          <label for="phone">Phone:</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo isset($customer['contact_number']) ? $customer['contact_number'] : ''; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>

  <?php include('footer.php');?>


  <!-- Link Bootstrap JS (optional) -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- jQuery Plugins -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/nouislider.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/productcp.js"></script>
  <script src="js/magnify.js" charset="utf-8"></script>

  <script>
    $(document).ready(function() {
      // Handle form submission with AJAX
      $('#accountSettingsForm').on('submit', function(e) {
        e.preventDefault();

        var name = $('#name').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var phone = $('#phone').val();

        $.ajax({
          url: 'profile.php',
          type: 'POST',
          data: {
            name: name,
            email: email,
            address: address,
            phone: phone
          },
          success: function(response) {
            // Reload the page to reflect the updated account information
            window.location.href = 'profile.php?success=1#account-info';
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('Failed to update account information. Please try again.');
          }
        });
      });
    });
  </script>
</body>
</html>
