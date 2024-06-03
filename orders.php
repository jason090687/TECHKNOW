<?php
include "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
    table {
        table-layout: fixed;
        width: 100%;
    }

    th,
    td {
        word-wrap: break-word;
        text-align: center;
        vertical-align: middle;
    }

    th:nth-child(3),
    td:nth-child(3) {
        width: 100px;
    }

    th:nth-child(7),
    td:nth-child(7) {
        width: 250px;
    }

    .container {
        max-height: 800px;
        /* Adjust the height as needed */
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
        <h2>Orders</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer ID</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM orders";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["order_id"] . "</td>";
                        echo "<td>" . $row["customer_id"] . "</td>";
                        echo "<td>" . $row["order_date"] . "</td>";
                        echo "<td>$" . number_format($row["total_amount"], 2) . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td>
                        <a class='btn btn-primary btn-sm' href='edit_order.php?order_id=" . $row["order_id"] . "'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='delete_order.php?order_id=" . $row["order_id"] . "'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No orders found</td></tr>";
                }
                $connect->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>