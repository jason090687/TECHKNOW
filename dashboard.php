<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="sidebar">
        <h2>Chichart Dashboard</h2>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
        <a href="intro_page.php">Logout</a>
    </div>
    <div class="main-content">
        <header>
            <h1>Dashboard</h1>
        </header>
        <div class="stats">
            <div class="stat">
                <h3>Total Sales</h3>
                <p>
                    <?php
                        include "db.php";
                        $sql = "SELECT SUM(total_amount) as total_sales FROM orders";
                        $result = $connect->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo "$" . number_format($row["total_sales"], 2);
                        } else {
                            echo "$0.00";
                        }
                        ?>
                </p>
            </div>
            <div class="stat">
                <h3>Orders</h3>
                <p>
                    <?php
                        $sql = "SELECT COUNT(*) as total_orders FROM orders";
                        $result = $connect->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row["total_orders"];
                        } else {
                            echo "0";
                        }
                        ?>
                </p>
            </div>
            <div class="stat">
                <h3>Customers</h3>
                <p>
                    <?php
                        include "db.php";
                        $sql = "SELECT COUNT(*) as total_customers FROM customers";
                        $result = $connect->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row["total_customers"];
                        } else {
                            echo "0";
                        }
                        $connect->close();
                        ?>
                </p>
            </div>
        </div>
        <div class="recent-orders">
            <h2>Customer</h2>
            <div class="text-end mb-2">
                <a class="btn btn-primary" href="get_config.php" role="button">Add Customer</a>
            </div>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Customer_id</th>
                        <th>Customer_name</th>
                        <th>Email</th>
                        <th>Shipping_address</th>
                        <th>Contact_number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "db.php";

                        // Read all the data 
                        $sql = "SELECT customer_id, customer_name, email, shipping_address, contact_number, password FROM customers";
                        $result = $connect->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["customer_id"] . "</td>";
                                echo "<td>" . $row["customer_name"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["shipping_address"] . "</td>";
                                echo "<td>" . $row["contact_number"] . "</td>";
                                echo "<td>
                                <a class='btn btn-primary btn-sm' href='update_config.php?customer_id=" . $row["customer_id"] . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='delete_config.php?id=" . $row["customer_id"] . "'>Delete</a>
                                    </td>";
                                echo "</tr>";
                            }
                        }
                        $connect->close();
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="js/dashboard.js"></script>
</body>

</html>