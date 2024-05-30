<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        table {
            table-layout: fixed;
            width: 100%;
        }
        th, td {
            word-wrap: break-word;
            text-align: center;
            vertical-align: middle;
        }
        th:nth-child(3), td:nth-child(3) {
            width: 100px;
        }
        th:nth-child(7), td:nth-child(7) {
            width: 250px;
        }
        .table-wrapper {
            max-height: 800px; /* Adjust the height as needed */
            overflow-y: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="sidebar">
            <h2>Chichart Dashboard</h2>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
            <button onclick="logout()">Logout</button>
        </div>
    <div class="container mt-5">
        <h2>Products</h2>
        <div class="text-end mb-3">
            <a class="btn btn-primary" href="add_product.php" role="button">Add New Product</a>
        </div>
        <div class="table-wrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Category ID</th>
                        <th>Supplier ID</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM products";
                    $result = $connect->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td><img src='uploads/" . $row["product_image"] . "' alt='" . $row["product_name"] . "' width='50'></td>";
                            echo "<td>" . $row["category_id"] . "</td>";
                            echo "<td>" . $row["supplier_id"] . "</td>";
                            echo "<td>$" . number_format($row["price"], 2) . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>
                            <a class='btn btn-primary btn-sm' href='edit_product.php?product_id=" . $row["product_id"] . "'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='delete_product.php?product_id=" . $row["product_id"] . "'>Delete</a>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No products found</td></tr>";
                    }
                    $connect->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
