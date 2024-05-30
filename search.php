<?php
session_start();
include("db.php");

$query = isset($_GET['query']) ? $_GET['query'] : '';

$search_results = [];
if (!empty($query)) {
    // Use prepared statements to prevent SQL injection
    $stmt = $connect->prepare("SELECT * FROM products WHERE product_name LIKE ?");
    $search_query = "%$query%";
    $stmt->bind_param("s", $search_query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Results - Chichart</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/search.css" />
</head>

<body>
    <?php include('header.php'); ?>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Search Results</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="index.php">Home</a></li>
                        <li class="active">Search Results</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <?php if (!empty($search_results)): ?>
                <?php foreach ($search_results as $product): ?>
                <div class="col-md-3 col-xs-6">
                    <div class="product">
                        <div class="product-img">
                            <?php if (file_exists("./img/" . $product['product_image'])): ?>
                            <img src="./img/<?= $product['product_image']; ?>" alt="">
                            <?php else: ?>
                            <img src="./img/placeholder.jpg" alt="Image not found">
                            <?php endif; ?>
                            <div class="product-label">
                                <span class="new">NEW</span>
                            </div>
                        </div>
                        <div class="product-body">
                            <p class="product-category"><?= $product['category_id']; ?></p>
                            <h3 class="product-name"><a
                                    href="product-detail.php?id=<?= $product['product_id']; ?>"><?= $product['product_name']; ?></a>
                            </h3>
                            <h4 class="product-price">₱<?= number_format($product['price'], 0, '.', ',') ?></h4>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="product-btns">
                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add
                                        to wishlist</span></button>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="col-md-12">
                    <p>No products found matching your query.</p>
                </div>
                <?php endif; ?>
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