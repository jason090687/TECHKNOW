<?php

include("../config.php");

// Delete a product
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];

    // Retrieve the product image path from the database
    $image_query = "SELECT product_image FROM products WHERE product_id = ?";
    $image_stmt = $connect->prepare($image_query);
    $image_stmt->bind_param("i", $product_id);
    $image_stmt->execute();
    $image_result = $image_stmt->get_result();
    $image_row = $image_result->fetch_assoc();
    $product_image = $image_row['product_image'];

    // Delete the product record from the database
    $delete_query = "DELETE FROM products WHERE product_id = ?";
    $delete_stmt = $connect->prepare($delete_query);
    $delete_stmt->bind_param("i", $product_id);

    if ($delete_stmt->execute()) {
        // Delete the product image file from the img folder
        if (file_exists($product_image)) {
            unlink($product_image);
        }

        echo "Product has been successfully deleted";
    } else {
        echo "Error: " . $delete_stmt->error;
    }

    // Close the prepared statements
    $image_stmt->close();
    $delete_stmt->close();

    // Redirect back to the admin page after deleting the product
    header("Location: admin.php");
    exit();
}

?>