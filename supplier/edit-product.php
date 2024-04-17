<?php
include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <title>Edit Product</title>
  <style>
    .form-container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-container h2 {
      margin-bottom: 20px;
    }

    .form-container label {
      font-weight: bold;
    }

    .form-container input[type="text"],
    .form-container input[type="file"],
    .form-container textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .form-container button[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-top: 20px;
      cursor: pointer;
    }
  </style>
</head>

<body>

  <?php
  if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Retrieve the product details based on the product_id
    $product_query = "SELECT * FROM products WHERE product_id = ?";
    $product_stmt = $connect->prepare($product_query);
    $product_stmt->bind_param("i", $product_id);
    $product_stmt->execute();
    $product_result = $product_stmt->get_result();
    $product_row = $product_result->fetch_assoc();

    // Check if the product exists
    if ($product_result->num_rows > 0) {
      // Display the edit form with the product details pre-filled
      ?>

      <div class="container mt-5">
        <div class="form-container">
          <h2>Edit Product</h2>
          <form action="update-product.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo $product_row['product_id']; ?>">

            <div class="form-group">
              <label for="product_name">Product Name</label>
              <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $product_row['product_name']; ?>">
            </div>

            <div class="form-group">
              <label for="description">Product Description</label>
              <textarea class="form-control" name="description" id="description" placeholder="Product Description" required><?php echo $product_row['description']; ?></textarea>
            </div>

            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" class="form-control" name="price" id="price" placeholder="Product Price">
            </div>

            <div class="form-group">
              <label for="discount_amount">Discount Amount</label>
              <input type="text" class="form-control" name="discount_amount" id="discount_amount" placeholder="Discount amount">
            </div>

            <div class="form-group">
              <label for="start_date">Start Date</label>
              <input type="date" class="form-control" name="start_date" id="start_date">
            </div>

            <div class="form-group">
              <label for="end_date">End Date</label>
              <input type="date" class="form-control" name="end_date" id="end_date">
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>

    <?php
    } else {
      echo "Product not found.";
    }

    $product_stmt->close();
  } else {
    echo "Invalid product ID.";
  }
  ?>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>