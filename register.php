<?php
session_start();
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['Full_Name'];
    $email = $_POST['Email'];
    $address = $_POST['Address'];
    $contact = $_POST['Contact'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate registration information
    if ($password !== $confirm_password) {
        header("Location: index.php?error=Passwords do not match");
        exit();
    }

    // Check if the email is already registered
    $query = "SELECT * FROM customers WHERE email = '$email'";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        header("Location: index.php?error=Email already registered");
        exit();
    }

    // Insert new customer into the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO customers (customer_name, email, shipping_address, contact_number, password) VALUES ('$full_name', '$email', '$address', '$contact', '$hashed_password')";
    if ($connect->query($query) === TRUE) {
        $customer_id = $connect->insert_id;
        $_SESSION['customer_id'] = $customer_id;
        header("Location: index.php");
        exit();
    } else {
        header("Location: index.php?error=Registration failed");
        exit();
    }
}
?>