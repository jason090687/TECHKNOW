<?php
session_start();
include("db.php");

// Assuming wishlist items are stored in session as 'wishlist'
$wishlist_items = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wishlist - Chichart</title>
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
                    <h3 class="breadcrumb-header">Your Wishlist</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Wishlist</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>ACTION</strong></div>
                        </div>
                        <div class="order-products">
                            <?php
                        if (!empty($wishlist_items)) {
                            foreach ($wishlist_items as $product_id => $item) {
                                ?>
                            <div class="order-col">
                                <div><?= $item['product_name']; ?></div>
                                <div>
                                    <a href="remove_from_wishlist.php?id=<?= $product_id; ?>"
                                        class="btn btn-danger">Remove</a>
                                    <a href="add_to_cart.php?id=<?= $product_id; ?>" class="btn btn-primary">Add to
                                        Cart</a>
                                </div>
                            </div>
                            <?php
                            }
                        } else {
                            echo "<div class='order-col'><div>Your wishlist is empty</div></div>";
                        }
                        ?>
                        </div>
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
</body>

</html>