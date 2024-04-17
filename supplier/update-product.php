<?php
include("../config.php");

if(isset($_POST['update'])){
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $discount_amount = $_POST['discount_amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Update the product information in the products table
    $update_query = "UPDATE products SET product_name = ?, description = ?, price = ? WHERE product_id = ?";
    $update_stmt = $connect->prepare($update_query);
    $update_stmt->bind_param("ssdi", $product_name, $description, $price, $product_id);

    // Update the discount information in the discounts table
    $discount_query = "UPDATE discounts SET discount_amount = ?, start_date = ?, end_date = ? WHERE product_id = ?";
    $discount_stmt = $connect->prepare($discount_query);
    $discount_stmt->bind_param("issi", $discount_amount, $start_date, $end_date, $product_id);

    // Execute both update queries within a transaction
    $connect->begin_transaction();

    try {
        // Update product information
        $update_stmt->execute();

        // Update discount information
        $discount_stmt->execute();

        // Commit the transaction
        $connect->commit();

        // Update successful
        header("Location: admin.php");
        exit();
    } catch (mysqli_sql_exception $exception) {
        // Rollback the transaction on error
        $connect->rollback();
        echo "Error: " . $exception->getMessage();
    }

    $update_stmt->close();
    $discount_stmt->close();
}
?>