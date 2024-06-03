<?php
session_start();
include("db.php");
$product_id = isset($_GET['id']) ? $_GET['id'] : "";

// Fetch Specific Product
$prod_sql = "SELECT * FROM products WHERE product_id = $product_id LIMIT 1";
$product_detail = $connect->query($prod_sql);
$current_product_cat_slug = "";
$product_data = array();

if ($product_detail->num_rows > 0) {
    // output data of each cat
    while ($prod = $product_detail->fetch_assoc()) {
        if($prod['product_id'] == $product_id){
            $category_id = $prod["category_id"];
            $product_data['product_name'] = $prod['product_name'];
			$product_data['description'] = $prod['description'];
            $product_data['price'] = $prod['price'];
			$product_data['product_image'] = $prod['product_image'];
            // Get product category
            $cat_sql = "SELECT * FROM categories where category_id = '$category_id'";
            $cat = $connect->query($cat_sql);
            if ($cat->num_rows > 0) {
                while ($row = $cat->fetch_assoc()) {
                    $current_product_cat_slug = $row["category_slug"];
                }
            }
        }
        
    }
}
//fetch product review
$review_sql = "SELECT * FROM reviews where product_id = '$product_id'";
$reviews = $connect->query($review_sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/magnify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>ChicHart - Online Shop</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom stylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <style>
    #review1 {
        display: block !important;
    }
    </style>
</head>

<body>

    <?php include('header.php');?>


    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="<?=substr($product_data['product_image'], 1);?>" alt="laptop" id="image"
                                class="zoom" data-magnify-src="<?=substr($product_data['product_image'], 1);?>">
                        </div>


                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">

                        <div class="product-preview">
                            <img src="./img/bg.jpg" alt="laptop">
                        </div>

                        <div class="product-preview">
                            <img src="<?=substr($product_data['product_image'], 1);?>" alt="laptop">
                        </div>

                        <div class="product-preview">
                            <img src="./img/bg.jpg" alt="laptop">
                        </div>
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name"><?=$product_data['product_name'];?></h2>
                        <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <a class="review-link" href="#reviews">10 Review(s) | Add your review</a>
                        </div>
                        <div>
                            <h3 class="product-price">₱<?=number_format($product_data['price'], 2);?></h3>
                            <span class="product-available">In Stock</span>
                        </div>
                        <p><?=$product_data['description'];?></p>

                        <div class="product-options">
                            <label>
                                Size
                                <select class="input-select">
                                    <option value="0">Default</option>
                                </select>
                            </label>
                            <label>
                                Color
                                <select class="input-select">
                                    <option value="0">Default</option>
                                </select>
                            </label>
                        </div>

                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            <button class="add-to-cart-btn working-add-to-cart" data-id="<?=$row['product_id'];?>"
                                data-productname="<?=$row['product_name'];?>" data-price="<?=$row['price'];?>"><i
                                    class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>


                        <ul class="product-links">
                            <li>Share:</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                        </ul>

                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab">Reviews</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <div id="review1" style="display:block !important;">
                            <!-- tab  -->
                            <div id="review1">
                                <div class="row">
                                    <!-- Rating -->
                                    <div class="col-md-3 col-md-offset-1">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                <span>4.5</span>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 80%;"></div>
                                                    </div>
                                                    <span class="sum">3</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 60%;"></div>
                                                    </div>
                                                    <span class="sum">2</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Rating -->

                                    <!-- Reviews -->
                                    <div class="col-md-6 col-md-offset-1">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                <?php
										
                                        if ($reviews->num_rows > 0) {
                                            // output data of each cat
                                            while ($row = $reviews->fetch_assoc()) { 
                                                $customer_id = $row['customer_id'];
                                                $query = "SELECT * FROM customers WHERE customer_id = $customer_id";
                                                $customer_result = $connect->query($query);
                                                if ($customer_result->num_rows > 0) {
                                                    while ($customer = $customer_result->fetch_assoc()) { 
                                                        $review_date = date_create($row['review_date']);
                                                        $review_date = date_format($review_date, 'F j, Y');
                                                ?>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name"><?=$customer['customer_name'];?></h5>
                                                        <p class="date"><?=$review_date;?></p>
                                                        <div class="review-rating">
                                                            <?php
                                                        $rating = $row['rating'];
                                                        for($i=1;$i<=$rating;$i++){
                                                            echo "<i class='fa fa-star'></i>";
                                                        }
                                                        for($i=5;$i>$rating;$i--){
                                                            echo "<i class='fa fa-star-o empty'></i>";
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p><?=$row['review_text'];?></p>
                                                    </div>
                                                </li>
                                                <?php 
                                                    } 
                                                }
                                            
                                            }
                                        }
                                        else {
                                            echo "No Review Yet.";
                                        }
                                        ?>

                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Reviews -->
                                    <!-- Review Form -->
                                    <div class="col-md-10 col-md-offset-1">
                                        <div id="review-form">
                                            <form class="review-form" action="#" method="POST">
                                                <input class="input" type="text" placeholder="Your Name"
                                                    name="customer_name" />
                                                <input class="input" type="email" placeholder="Your Email"
                                                    name="customer_email" />
                                                <input class="input" type="hidden" name="product_id"
                                                    value="<?=$product_id;?>" />
                                                <textarea class="input" name="review"
                                                    placeholder="Your Review"></textarea>
                                                <div class="input-rating">
                                                    <span>Your Rating: </span>
                                                    <div class="stars">
                                                        <input id="star5" name="rating" value="5" type="radio" /><label
                                                            for="star5"></label>
                                                        <input id="star4" name="rating" value="4" type="radio" /><label
                                                            for="star4"></label>
                                                        <input id="star3" name="rating" value="3" type="radio" /><label
                                                            for="star3"></label>
                                                        <input id="star2" name="rating" value="2" type="radio" /><label
                                                            for="star2"></label>
                                                        <input id="star1" name="rating" value="1" type="radio" /><label
                                                            for="star1"></label>
                                                    </div>
                                                </div>
                                                <button class="primary-btn" type="submit" name="submit">Submit</button>
                                            </form>
                                            <?php   
                                        if(isset($_POST['submit'])){
                                            $review_date = date('Y-m-d');
                                            $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : "1";
                                            $review = isset($_POST['review']) ? $_POST['review'] : "";
                                            $rating = isset($_POST['rating']) ? $_POST['rating'] : "";
                                            $review_insert_query = "INSERT INTO reviews (product_id, customer_id, review_text, rating, review_date) VALUES ('$product_id', '$customer_id', '$review', '$rating', '$review_date')";
                                            $review_insert_stmt = $connect->prepare($review_insert_query);
                                            $review_insert_stmt->execute();
                                            
                                        }
                                        ?>
                                        </div>
                                    </div>
                                    <!-- /Review Form -->
                                </div>
                            </div>
                            <!-- /tab3  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Related Products</h3>
                    </div>
                </div>
                <!-- product -->
                <?php
                        // Fetch Specific Product
                        $prod_sql = "SELECT * FROM products LIMIT 4";
                        $product_detail = $connect->query($prod_sql);
                        if ($product_detail->num_rows > 0) {
                            // Output the rest of the product
                            while ($prods = $product_detail->fetch_assoc()) {
                                if($prods['product_id'] != $product_id){
                                // Fetch Product Category
                                $category_name = "";
                                $cat_id = $prods['category_id'];
                                $prod_category = "SELECT * FROM categories WHERE category_id = $cat_id LIMIT 1";
                                $category_data = $connect->query($prod_category);
                                if ($category_data->num_rows > 0) {
                                    // output data of each cat
                                    while ($cat_data = $category_data->fetch_assoc()) {
                                        $category_name = $cat_data['category_name'];
                                        break;
                                    }
                                }
                            ?>
                <div class="col-md-3 col-xs-6">
                    <div class="product">
                        <div class="product-img">
                            <img src="./img/watch/W5.png" alt="">
                            <div class="product-label">

                            </div>
                        </div>
                        <div class="product-body">
                            <p class="product-category"><?=$category_name;?></p>
                            <h3 class="product-name"><a
                                    href="product-detail.php?id=<?=$prods['product_id'];?>"><?=$prods['product_name'];?></a>
                            </h3>
                            <h4 class="product-price">₱<?=number_format($prods['price'], 2);?></h4>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="product-btns">
                                <button class="add-to-wishlist">
                                    <i class="fa fa-heart-o"></i>
                                    <span class="tooltipp">Add to Wishlist</span>
                                </button>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
                    </div>
                </div>
                <?php
                                }
                            }
                        }
                    ?>

                <!-- /product -->

                <!-- product -->


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /Section -->

    <?php include('footer.php');?>
    <!-- jQuery Plugins -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/magnify.js" charset="utf-8"></script>
    <script src="js/store.js"></script>

</body>

</html>