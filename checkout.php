<?php
session_start();
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Techknow - Online Shop</title>

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
		<?php include('header.php');?>
		
		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li class="active">Checkout</li>
						</ul>
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
				<form action="#" method="POST">
				<?php
				if(isset($_POST['submit'])){
					$order_date = date('Y-m-d');
					$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : "1";
					$order_insert_query = "INSERT INTO orders (customer_id, order_date, total_amount, status) VALUES ('$customer_id', '$order_date', '$subtotal', 'pending')";
					if($connect->query($order_insert_query) === TRUE){
						$order_id = $connect->insert_id;
						$shipping_address = (isset($_POST['address']) ? $_POST['address'] : "")." ".(isset($_POST['city'] ) ? $_POST['city'] : "")." ".(isset($_POST['country']) ? $_POST['country'] : "")." ".(isset($_POST['zip_code']  ) ? $_POST['zip_code'] : "");
						// Insert the data to the other 2 tables
						$shipping_insert_query = "INSERT INTO shipping (order_id, shipping_date, address) VALUES ('$order_id', '$order_date', '$shipping_address')";
						$connect->query($shipping_insert_query);

						$payment_insert_query = "INSERT INTO payments (order_id, payment_date, amount, payment_method	
						) VALUES ('$order_id', '$order_date', '$subtotal', 'cod')";
						$connect->query($payment_insert_query);
						echo "We have seccessfully processed your order";
						$_SESSION['products'] = array();
					}
					
				}
				?>
				<!-- row -->
				<?php if(!empty($_SESSION['products'])):?>
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Billing/Shipping address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="fullname" placeholder="Full Name">
							</div>
		
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip_code" placeholder="ZIP Code">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="Telephone">
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									
									<div class="caption">
										<p>To proceed in creating account kindly put your password here</p>
										<input class="input" type="password" name="password" placeholder="Enter Your Password">
									</div>
								</div>
							</div>
						</div>
						<!-- /Billing Details -->

						

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" placeholder="Order Notes"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
							<?php
								$subtotal = 0;
								if(!empty($_SESSION['products'])){
									foreach($_SESSION['products'] as $product){
										$subtotal = $subtotal + $product['price'];
								?>
								<div class="order-col">
									<div>1x <?=$product['product_name'];?></div>
									<div> ₱<?=number_format($product['price'],2);?></div>
								</div>
								<?php
									}
								}
								else {
									echo "Empty Cart";
								}
								?>
							</div>
							<div class="order-col">
								<div>Shipping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">₱<?=number_format($subtotal,2);?></strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input  type="hidden" name="total_amount" value="<?=$subtotal;?>"/>
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Cash on Delivery
								</label>
								<div class="caption">
									<p>Prepare the exact amount when order is delivered to lessen inconvenience.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Paypal Payment
								</label>
								<div class="caption">
									<p>This payment method is not available.</p>
								</div>
							</div>
					
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
					<button type="submit" name="submit" class="primary-btn order-submit">Place Order</button>
						
					</div>
					<!-- /Order Details -->
				</div>
				<?php else:?>
					<?php if(!isset($_POST['submit'])):?>
					You have an empty cart.
					<?php endif;?>
				<?php endif;?>
				<!-- /row -->
				
				</form>
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		<?php include('footer.php');?>
		
		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
