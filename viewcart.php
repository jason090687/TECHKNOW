<?php
session_start();
include("db.php");

// Define subtotal
$subtotal = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Cart - Chichart</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
</head>

<body>
    <?php include('header.php'); ?>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Your Cart</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">View Cart</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            <?php
                        if (!empty($_SESSION['products'])) {
                            foreach ($_SESSION['products'] as $product) {
                                $subtotal += (float)$product['price'];
                                ?>
                            <div class="order-col">
                                <div>1x <?= $product['product_name']; ?></div>
                                <div>₱<?= number_format($product['price'], 2); ?></div>
                            </div>
                            <?php
                            }
                        } else {
                            echo "<div class='order-col'><div>Empty Cart</div></div>";
                        }
                        ?>
                        </div>
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">₱<?= number_format($subtotal, 2); ?></strong></div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="checkout.php" class="primary-btn order-submit">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/add_to_wishlist.js"></script>
</body>

</html>