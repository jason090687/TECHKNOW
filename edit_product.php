<?php
include 'db.php';

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE product_id='$product_id'";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Product not found";
        exit();
    }
} else {
    echo "Invalid request";
    exit();
}
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Product</h2>
        <form action="add_edit_product.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $row['product_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="product_image" class="form-label">Product Image:</label>
                <input type="file" class="form-control" id="product_image" name="product_image">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category ID:</label>
                <input type="text" class="form-control" id="category_id" name="category_id" value="<?php echo $row['category_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="supplier_id" class="form-label">Supplier ID:</label>
                <input type="text" class="form-control" id="supplier_id" name="supplier_id" value="<?php echo $row['supplier_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $row['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $row['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</body>
</html>
