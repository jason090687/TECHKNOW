<?php
session_start();
include("db.php");
// Fetch Products
$products = "SELECT * FROM products ORDER BY product_id DESC";
$product_lists = $connect->query($products);
?>

<!DOCTYPE html>
<html lang="en">

<head>
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

</head>

<body>
    <?php
include('header.php');
?>



    <!-- SECTION -->
    <!-- container -->
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>

                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <?php
										if ($product_lists->num_rows > 0) {
											// Output data of each product
											while ($row = $product_lists->fetch_assoc()) {
												// Retrieve category information
												$category_id = $row['category_id'];
												$category_query = "SELECT category_name FROM categories WHERE category_id = '$category_id'";
												$category_result = $connect->query($category_query);
												$category_row = $category_result->fetch_assoc();
												$category_name = $category_row['category_name'];
												?>
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <?php if (file_exists("./img/" . $row['product_image'])) { ?>
                                            <img src="./img/<?= $row['product_image']; ?>" alt="">
                                            <?php } else { ?>
                                            <img src="./img/placeholder.jpg" alt="Image not found">
                                            <?php } ?>
                                            <div class="product-label">
                                                <span class="new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category"><?= $category_name; ?></p>
                                            <h3 class="product-name"><a
                                                    href="product-detail.php?id=<?= $row['product_id']; ?>"><?= $row['product_name']; ?></a>
                                            </h3>
                                            <h4 class="product-price">₱<?= number_format($row['price'], 0, '.', ',') ?>
                                            </h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist" data-id="<?= $row['product_id']; ?>"
                                                    data-productname="<?= $row['product_name']; ?>"
                                                    data-price="<?= $row['price']; ?>">
                                                    <i class="fa fa-heart-o"></i>
                                                    <span class="tooltipp">Add to Wishlist</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn working-add-to-cart"
                                                data-id="<?= $row['product_id']; ?>"
                                                data-productname="<?= $row['product_name']; ?>"
                                                data-price="<?= $row['price']; ?>"><i class="fa fa-shopping-cart"></i>
                                                add to cart
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /product -->
                                    <?php
											}
										} else {
											echo "NO NEW PRODUCT ADDED YET.";
										}
										?>

                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top TechKnow products</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="./img/camera/C6.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Camera</p>
                                            <h3 class="product-name"><a href="#">Canon Eos6D</a></h3>
                                            <h4 class="product-price">₱21,000</h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div>
                                                <a href="wishlist.php" id="wishlist-link">
                                                    <i id="wishlist-icon" class="fa fa-heart-o"></i>
                                                    <span>Your Wishlist</span>
                                                    <div id="wishlist-quantity" class="qty">0</div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="./img/watch/W4.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Smartwatches</p>
                                            <h3 class="product-name"><a href="#">FitbitSense Smartwatch</a></h3>
                                            <h4 class="product-price"> ₱5,766</h4>
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
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="./img/laptop/L8.png" alt="">
                                            <div class="product-label">
                                                <span class="sale">-25%</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Laptops</p>
                                            <h3 class="product-name"><a href="#">Asus Vivobook X413JA</a></h3>
                                            <h4 class="product-price">₱28,492<del
                                                    class="product-old-price">₱37,990</del></h4>
                                            <div class="product-rating">
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist">
                                                    <i class="fa fa-heart-o"></i>
                                                    <span class="tooltipp">Add to Wishlist</span>
                                                </button>
                                            </div>div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="./img/headphone/H3.png" alt="">
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Headphones</p>
                                            <h3 class="product-name"><a href="#">Anko</a></h3>
                                            <h4 class="product-price">₱3,199</h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist">
                                                    <i class="fa fa-heart-o"></i>
                                                    <span class="tooltipp">Add to Wishlist</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="./img/laptop/L3.png" alt="">
                                            <div class="product-label">
                                                <span class="new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Laptops</p>
                                            <h3 class="product-name"><a href="#">ASPIRE 5 ACER</a></h3>
                                            <h4 class="product-price"> ₱33,000</h4>
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist">
                                                    <i class="fa fa-heart-o"></i>
                                                    <span class="tooltipp">Add to Wishlist</span>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </div>
                                    </div>
                                    <!-- /product -->
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling Laptops</h4>
                        <div class="section-nav">
                            <div id="slick-nav-3" class="products-slick-nav"></div>

                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        <div>
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/laptop/L2.png" alt="">


                                </div>
                                <div class="product-body">
                                    <p class="product-category">Laptops</p>
                                    <h3 class="product-name"><a href="#">Hp HQHovies</a></h3>
                                    <h4 class="product-price">₱31,990</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/laptop/L5.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Laptops</p>
                                    <h3 class="product-name"><a href="#">Acer Aspire 7</a></h3>
                                    <h4 class="product-price">₱37,093<del class="product-old-price">₱52,990</del></h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/laptop/L6.png" alt="">

                                </div>
                                <div class="product-body">
                                    <p class="product-category">Laptops</p>
                                    <h3 class="product-name"><a href="#">HP Pavilion 15</a></h3>
                                    <h4 class="product-price">₱33,699</h4>
                                </div>
                            </div>
                            <!-- product widget -->
                        </div>

                        <div>
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/laptop/L1.png" alt="">

                                </div>
                                <div class="product-body">
                                    <p class="product-category">Laptops</p>
                                    <h3 class="product-name"><a href="#">K9 Samsung Laptop</a></h3>
                                    <h4 class="product-price">₱25,199 </h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/laptop/L9.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Laptops</p>
                                    <h3 class="product-name"><a href="#">ASUS Vivobook</a></h3>
                                    <h4 class="product-price">₱42,000</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/laptop/L8.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Laptops</p>
                                    <h3 class="product-name"><a href="#">Asus Vivobook X413JA</a></h3>
                                    <h4 class="product-price">₱28,492<del class="product-old-price">₱37,990</del></h4>
                                </div>
                            </div>
                            <!-- product widget -->
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling Cellphones</h4>
                        <div class="section-nav">
                            <div id="slick-nav-4" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-4">
                        <div>
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/cellphones/CP2.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Cellphones</p>
                                    <h3 class="product-name"><a href="#">Huawei Mate 40</a></h3>
                                    <h4 class="product-price">₱25,850</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/cellphones/CP4.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Cellphones</p>
                                    <h3 class="product-name"><a href="#">TECNO POVA 4 Pro</a></h3>
                                    <h4 class="product-price">₱10,599</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/cellphones/CP3.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Cellphones</p>
                                    <h3 class="product-name"><a href="#">Huawei Nova 10</a></h3>
                                    <h4 class="product-price"> ₱25,399</h4>
                                </div>
                            </div>
                            <!-- product widget -->
                        </div>

                        <div>
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/cellphones/CP7.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Cellphones</p>
                                    <h3 class="product-name"><a href="#">Samsung Galaxy A14</a></h3>
                                    <h4 class="product-price">₱20,699</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/cellphones/CP5.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Cellphones</p>
                                    <h3 class="product-name"><a href="#">Samsung J7</a></h3>
                                    <h4 class="product-price">₱9,405</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/cellphones/CP8.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Cellphones</p>
                                    <h3 class="product-name"><a href="#">Samsung Galaxy S22 Ultra</a></h3>
                                    <h4 class="product-price">₱29,399</h4>
                                </div>
                            </div>
                            <!-- product widget -->
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm visible-xs"></div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling Smartwatches</h4>
                        <div class="section-nav">
                            <div id="slick-nav-5" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-5">
                        <div>
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/watch/W3.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Smartwatches</p>
                                    <h3 class="product-name"><a href="#">Samsung 3tty</a></h3>
                                    <h4 class="product-price">₱3,859</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/watch/W6.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Smartwatches</p>
                                    <h3 class="product-name"><a href="#">Apple Watch Ultra</a></h3>
                                    <h4 class="product-price">₱5,999</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/watch/W1.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Smartwatches</p>
                                    <h3 class="product-name"><a href="#">Rire 7ty</a></h3>
                                    <h4 class="product-price">₱2,130</h4>
                                </div>
                            </div>
                            <!-- product widget -->
                        </div>

                        <div>
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/watch/W7.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Smartwatches</p>
                                    <h3 class="product-name"><a href="#">Google Pixel Watch</a></h3>
                                    <h4 class="product-price">₱9,600</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/watch/W4.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Smartwatches</p>
                                    <h3 class="product-name"><a href="#">Fitbit Sense</a></h3>
                                    <h4 class="product-price">₱5,766</h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="./img/watch/W10.png" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">Smartwatches</p>
                                    <h3 class="product-name"><a href="#">Tic Watch Pro3</a></h3>
                                    <h4 class="product-price">₱2,899</h4>
                                </div>
                            </div>
                            <!-- product widget -->
                        </div>
                    </div>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <?php
		include('footer.php');
	?>

    <!-- jQuery Plugins -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/store.js"></script>
    <script src="path/to/font-awesome/js/font-awesome.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js"></script>
    <script src="js/add_to_wishlist.js"></script>
    <script>
    var ajax_dir = "<?php echo basename(dirname(__FILE__));?>/";
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var daysElement = document.getElementById('days');
        var hoursElement = document.getElementById('hours');
        var minutesElement = document.getElementById('minutes');
        var secondsElement = document.getElementById('seconds');

        var endDate = new Date('2023-06-13T23:59:59'); // Replace with your desired end date and time

        function updateCountdown() {
            var currentDate = new Date();
            var timeLeft = countdown(endDate, currentDate);

            daysElement.innerHTML = timeLeft.days;
            hoursElement.innerHTML = timeLeft.hours;
            minutesElement.innerHTML = timeLeft.minutes;
            secondsElement.innerHTML = timeLeft.seconds;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
    $('.navbar-nav li').removeClass('active');
    $('.navbar-nav li:first-child').addClass('active');
    </script>

</body>

</html>