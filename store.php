<?php
session_start();
include("db.php");
// Fetch Products
// iF has category, select from specific category
$cat = isset($_GET['cat']) ? $_GET['cat'] : "all";
$s = isset($_GET['s']) ? $_GET['s'] : "";
$cat_id = "";
if($s != ""){
	if($cat != "all"){
		// Fetch category data
		// fetch categories
		$cats = "SELECT * FROM categories WHERE category_slug = '$cat' LIMIT 1";
		$cat_lists = $connect->query($cats);
		if ($cat_lists->num_rows > 0) {
			while ($row = $cat_lists->fetch_assoc()) {
				$cat_id = $row['category_id'];
				break;
			}
		}
		$products = "SELECT * FROM products WHERE category_id = $cat_id AND product_name LIKE '%$s%' ORDER BY product_id";
	} 
	else {
		$products = "SELECT * FROM products WHERE product_name LIKE '%$s%' ORDER BY product_id DESC";
	}
}
else {
	if($cat != "all"){
		// Fetch category data
		// fetch categories
		$cats = "SELECT * FROM categories WHERE category_slug = '$cat' LIMIT 1";
		$cat_lists = $connect->query($cats);
		if ($cat_lists->num_rows > 0) {
			while ($row = $cat_lists->fetch_assoc()) {
				$cat_id = $row['category_id'];
				break;
			}
		}
		$products = "SELECT * FROM products WHERE category_id = $cat_id ORDER BY product_id";
	} 
	else {
		$products = "SELECT * FROM products ORDER BY product_id DESC";
	}
}

$product_lists = $connect->query($products);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>ChicHart - Online Shop</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>

    </head>
	<body>
		<!-- HEADER -->
<?php include('header.php');?>
		
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<div><br><br><br></div>
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">All Brands</h3>
							<div class="checkbox-filter">

								<div class="input-checkbox">
									<label for="category-1">
										<span></span>
										SAMSUNG
									</label>
								</div>

								<div class="input-checkbox">
									<label for="category-2">
										<span></span>
										ASUS
									</label>
								</div>

								<div class="input-checkbox">
									<label for="category-3">
										<span></span>
										ACER
									</label>
								</div>

								<div class="input-checkbox">
									<label for="category-4">
										<span></span>
										CANON
									</label>
								</div>

								<div class="input-checkbox">
									<label for="category-5">
										<span></span>
										JBL
									</label>
								</div>

								<div class="input-checkbox">
									<label for="category-5">
										<span></span>
										SONY
									</label>
								</div>
								
								<div class="input-checkbox">
									<label for="category-5">
										<span></span>
										HUAWEI
									</label>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->
						<div><br><br><br><br></div>
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<div><br><br><br><br></div>
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Top selling</h3>
							<div class="product-widget">
								<div class="product-img">
									<img src="./img/headphone/H1.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Headphones</p>
									<h3 class="product-name"><a href="#">Marshall</a></h3>
									<h4 class="product-price">₱3,300</h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									<img src="./img/camera/C2.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Camera</p>
									<h3 class="product-name"><a href="#">Canon EosC</a></h3>
									<h4 class="product-price">₱22,090</h4>
								</div>
							</div>
							<div class="product-widget">
								<div class="product-img">
									<img src="./img/watch/W10.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Smartwatches</p>
									<h3 class="product-name"><a href="#"></a>Tic Watch Pro3</a></h3>
									<h4 class="product-price">₱2,899</h4>
								</div>
							</div>
							<div class="product-widget">
								<div class="product-img">
									<img src="./img/cellphones/CP3.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Cellphones</p>
									<h3 class="product-name"><a href="#">Huawei Nova 10</a></h3>
									<h4 class="product-price">₱25,399</h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									<img src="./img/laptop/L5.png" alt="">
									
								</div>
								<div class="product-body">
									<p class="product-category">Laptops</p>
									<h3 class="product-name"><a href="#">Ace Aspire 7</a></h3>
									<h4 class="product-price">₱37,093 <del class="product-old-price">₱52,990</del></h4>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store-products" class="col-md-9">

						<!-- store products -->
						<div class="row">

						<?php
		if ($product_lists->num_rows > 0) {
			// output data of each product
			while ($row = $product_lists->fetch_assoc()) {
				$category_name = "Unknown"; // Default category name if category not found

				// Fetch the category name from the categories table
				$category_query = "SELECT category_name FROM categories WHERE category_id = " . $row['category_id'];
				$category_result = $connect->query($category_query);

        if ($category_result && $category_result->num_rows > 0) {
            $category_row = $category_result->fetch_assoc();
            $category_name = $category_row['category_name'];
        }

        ?>
<!-- product -->
<div class="col-md-4 col-xs-6">
    <div class="product">
        <div class="product-img" id="JBL Pro Headphone">
            <img src="./img/<?=$row['product_image'];?>" alt="">
            <div class="product-label">
                <?php
                // Fetch discount_amount from the discounts table based on product_id or any relevant criteria
                $product_id = $row['product_id'];
                $discount_query = "SELECT discount_amount FROM discounts WHERE product_id = $product_id";
                $connect = new mysqli($servername, $username, $password, $dbname);
                $discount_result = mysqli_query($connect, $discount_query); // Execute the discount query
                if ($discount_result && mysqli_num_rows($discount_result) > 0) {
                    $discount_row = mysqli_fetch_assoc($discount_result);
                    $discount_amount = $discount_row['discount_amount'];
                    if ($discount_amount > 0) {
                        $discount_percentage = ($discount_amount / $row['price']) * 100;
                        // Calculate the updated price
                        $updated_price = $row['price'] - $discount_amount;
                        $formatted_price = number_format($updated_price, 0, '.', ',');
                        ?>
                        <span class="sale" style="position: absolute; top: -15px; left: -35px;">-<?= number_format($discount_percentage, 0) ?>%</span>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="product-body">
                <p class="product-category"><?= $category_name; ?></p>
                <h3 class="product-name"><a href="product-detail.php?id=<?=$row['product_id'];?>"><?=$row['product_name']?></a></h3>
                <?php if (isset($formatted_price)) { ?>
                    <h4 class="product-price">₱<?=$formatted_price?></h4>
                    <?php if ($discount_amount > 0) { ?>
                        <del class="product-old-price">₱<?= number_format($row['price'], 0, '.', ',') ?></del>
                    <?php } ?>
                <?php } else { ?>
                    <h4 class="product-price">₱<?= number_format($row['price'], 0, '.', ',') ?></h4>
                <?php } ?>
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
        </div>
        <div class="add-to-cart">
			<button class="add-to-cart-btn working-add-to-cart" data-id="<?=$row['product_id'];?>" data-productname="<?=$row['product_name'];?>" data-price="<?=$row['price'];?>"><i class="fa fa-shopping-cart"></i> add to cart</button>
		</div>
    </div>
</div>
<!-- /product -->
<?php
    }
} 
else {
    echo "NO PRODUCT ADDED YET";
}
?>
</div></div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

<?php include('footer.php'); ?>

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/store.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>var ajax_dir = "<?php echo basename(dirname(__FILE__));?>/";</script>



	</body>
</html>