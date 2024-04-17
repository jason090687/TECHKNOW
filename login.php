<?php
session_start();
include("config.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve the user's credentials from the form
  $email = $_POST['email'];
  $password = $_POST['password'];

  // check if user exist
$customer_sql = "SELECT customer_id FROM customers WHERE email = '$email' LIMIT 1";
$customer_exists = $connect->query($customer_sql);
if ($customer_exists->num_rows > 0) {
  while ($row = $customer_exists->fetch_assoc()) {
   $customer_id = $row['customer_id'];
  }
}
  // TODO: Add code to verify the user's credentials and log them in

  // Assuming login is successful

  // Set the user's session information
  $_SESSION['customer_id'] = $customer_id; // Replace with the actual user ID

  // Redirect the user to their profile page
  header("Location: index.php");
  exit();
}
?>