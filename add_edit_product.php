<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $supplier_id = $_POST['supplier_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle file upload
    if (!empty($_FILES['product_image']['name'])) {
        $product_image = $_FILES['product_image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($product_image);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            if (isset($_POST['product_id'])) {
                $product_id = $_POST['product_id'];

                $sql = "UPDATE products SET product_name='$product_name', product_image='$product_image', category_id='$category_id', supplier_id='$supplier_id', price='$price', description='$description' WHERE product_id='$product_id'";

                if ($connect->query($sql) === TRUE) {
                    echo "Product updated successfully";
                } else {
                    echo "Error updating product: " . $connect->error;
                }

            } else {
                $sql = "INSERT INTO products (product_name, product_image, category_id, supplier_id, price, description) 
                        VALUES ('$product_name', '$product_image', '$category_id', '$supplier_id', '$price', '$description')";

                if ($connect->query($sql) === TRUE) {
                    echo "New product created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $connect->error;
                }
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        if (isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];

            $sql = "UPDATE products SET product_name='$product_name', category_id='$category_id', supplier_id='$supplier_id', price='$price', description='$description' WHERE product_id='$product_id'";

            if ($connect->query($sql) === TRUE) {
                echo "Product updated successfully";
            } else {
                echo "Error updating product: " . $connect->error;
            }
        }
    }

    $connect->close();
    header("Location: products.php");
    exit();
}
?>
