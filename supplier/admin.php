<?php
include("../config.php");

if(isset($_POST['submit'])){
    $product_name = $_POST['product_name'];
    $description = $_POST['product_description'];
    $price = $_POST['price'];

    // Check if the 'category_id' key is set in $_POST array
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';

    // Retrieve the supplier information
    $supplier_name = $_POST['supplier_name'];
    $email = $_POST['email'];
    $supplier_address = $_POST['supplier_address'];
    $contact_number = $_POST['contact_number'];

    // Check if the supplier already exists in the suppliers table
    $supplier_query = "SELECT supplier_id FROM suppliers WHERE supplier_name = ? AND email = ? AND supplier_address = ? AND contact_number = ?";
    $supplier_stmt = $connect->prepare($supplier_query);
    $supplier_stmt->bind_param("ssss", $supplier_name, $email, $supplier_address, $contact_number);
    $supplier_stmt->execute();
    $supplier_result = $supplier_stmt->get_result();

    if ($supplier_result->num_rows > 0) {
        // Supplier already exists, retrieve the existing supplier_id
        $supplier_row = $supplier_result->fetch_assoc();
        $supplier_id = $supplier_row['supplier_id'];
    } else {
        // Supplier does not exist, insert the supplier information into the suppliers table
        $supplier_insert_query = "INSERT INTO suppliers (supplier_name, email, supplier_address, contact_number) VALUES (?, ?, ?, ?)";
        $supplier_insert_stmt = $connect->prepare($supplier_insert_query);
        $supplier_insert_stmt->bind_param("ssss", $supplier_name, $email, $supplier_address, $contact_number);
        $supplier_insert_stmt->execute();

        // Retrieve the newly inserted supplier_id
        $supplier_id = $supplier_insert_stmt->insert_id;

        $supplier_insert_stmt->close();
    }

    // Handle the uploaded image
    $product_image = '';
    if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK){
        $tempFile = $_FILES['product_image']['tmp_name'];
        $fileExtension = pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION);
        $targetDirectory = '../img/';
        $targetFile = $targetDirectory . uniqid('img_') . '.' . $fileExtension;

        // Move the uploaded image to the target directory
        if(move_uploaded_file($tempFile, $targetFile)){
            $product_image = $targetFile;
        } else {
            echo "Error uploading the image.";
        }
    }

    // Insert the product information into the products table
    $prod_query = "INSERT INTO products (product_name, product_image, category_id, supplier_id, price, description) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $connect->prepare($prod_query);
    $stmt->bind_param("ssisis", $product_name, $product_image, $category_id, $supplier_id, $price, $description);

    if ($stmt->execute()) {
        $product_id = $stmt->insert_id;

        // Check if discount information is provided
        if (isset($_POST['discount_amount'], $_POST['start_date'], $_POST['end_date'])) {
            $discount_amount = $_POST['discount_amount'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];

            // Insert the discount information into the discounts table
            $discount_query = "INSERT INTO discounts (product_id, discount_amount, start_date, end_date) VALUES (?, ?, ?, ?)";

            $discount_stmt = $connect->prepare($discount_query);
            $discount_stmt->bind_param("iiss", $product_id, $discount_amount, $start_date, $end_date);

            if ($discount_stmt->execute()) {
                header("Location: admin.php");
                        exit();
            } else {
                echo "Error: " . $discount_stmt->error;
            }

            $discount_stmt->close();
        } else {
            echo "Product has been successfully added without discount";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


// Retrieve and display all products with their information
$product_query = "SELECT products.*, discounts.discount_amount, discounts.start_date, discounts.end_date, categories.category_name FROM products LEFT JOIN discounts ON products.product_id = discounts.product_id LEFT JOIN categories ON products.category_id = categories.category_id";
$product_result = $connect->query($product_query);

// Retrieve and display all suppliers
$supplier_query = "SELECT * FROM suppliers";
$supplier_result = $connect->query($supplier_query);

// Retrieve and display all customers
$customer_query = "SELECT * FROM customers";
$customer_result = $connect->query($customer_query);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>TechKnow - Online Shop</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="../css/slick.css"/>
    <link type="text/css" rel="stylesheet" href="../css/slick-theme.css"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="../css/nouislider.min.css"/>
    

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="../css/style.css"/>
    <link type="text/css" rel="stylesheet" href="admin.css"/>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0934-495-4327</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> techknow@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 9000 Lapasan Road</a></li>>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#">₱ PHP</a></li>
						<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						 <!-- LOGO -->
                         <div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<a href="index.php"><img src="./img/logo.png" alt=""></a>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
                    <div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<a href="index.php"><img src="../img/logo.png" alt=""></a>
								</a>
							</div>
						</div>
						<!-- /LOGO -->
				    </div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->
               
	
		<!-- BREADCRUMB -->
            <div id="breadcrumb" class="section">
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col6-md-12">
                            <h3 class="breadcrumb-header">ADMIN PANEL</h3>
                            <ul class="breadcrumb-tree">
                                <li class="active"><a href="#">Home</a></li>
                                <li><a href="#adding-product">Add Product</a></li>
                                <li><a href="#product-Info">Product Information</a></li>
                                <li><a href="#supplier-Info">Supplier Information</a></li>
                                <li><a href="#customer-Info">Customer Information</a></li>

                            </ul>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
        <!-- /BREADCRUMB -->

    <div class="container">
    
    <section id="adding-product">
    <form action="admin.php" method="POST" enctype="multipart/form-data">
        <h2><br>Adding Product</h2><br>
        <label for="product_name">Product Name</label>
        <input type="text" name="product_name" id="product_name" placeholder="Product Name"/><br>

        <label for="product_image">Product Image</label>
        <input type="file" name="product_image" id="product_image"  required/> <br>

        <label for="product_description">Product Description</label>
        <textarea name="product_description" id="product_description" placeholder="Product Description" required></textarea><br> 

        <label for="price">Price</label>
        <input type="text" name="price" id="price" placeholder="Product Price"/><br>

        <label for="discount_amount">Discount Amount</label>
        <input type="text" name="discount_amount" id="discount_amount" placeholder="Discount amount"><br>

        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date"><br>

        <label for="end_date">End Date</label>
        <input type="date" name="end_date" id="end_date"><br>

        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" required>
            <option value="1">Laptops</option>
            <option value="2">Smartwatches</option>
            <option value="3">Cellphones</option>
            <option value="4">Cameras</option>
            <option value="5">Headphones</option>
        </select>

        <br><label for="supplier_name">Supplier Name</label>
        <input type="text" name="supplier_name" id="supplier_name" placeholder="Supplier Name" required/><br>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="email" required/><br>

        <label for="supplier_address">Supplier Address</label>
        <input type="text" name="supplier_address" id="supplier_address" placeholder="Supplier Address" required/><br>

        <label for="contact_number">Contact Number</label>
        <input type="text" name="contact_number" id="contact_number" placeholder="Contact Number" required/><br>

        <button type="submit" name="submit" class='save-button' >Save</button>
    </form> 
</section>

    </section>

    <section id="product-Info">
        <div class="container">
            <h2><br><br>Product Information</h2><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Discounted Amount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th> <!-- New column -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($product_result->num_rows > 0) {
                    while ($product_row = $product_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $product_row['product_name'] . "</td>";
                        echo "<td><img src='" . $product_row['product_image'] . "' alt='Product Image' width='100'></td>";
                        echo "<td>₱" . $product_row['price'] . "</td>";
                        echo "<td>" . $product_row['description'] . "</td>";
                        echo "<td>" . $product_row['category_name'] . "</td>";
                        echo "<td>" . (isset($product_row['discount_amount']) ? "₱" . $product_row['discount_amount'] : "N/A") . "</td>";
                        echo "<td>" . $product_row['start_date'] . "</td>";
                        echo "<td>" . $product_row['end_date'] . "</td>";
                        echo "<td>";
                        echo "<a href='edit-product.php?product_id=" . $product_row['product_id'] . "' class='edit-button'>Edit</a>"; 
                        echo "<a href='delete-product.php?delete=" . $product_row['product_id'] . "' class='delete-button'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <section id="supplier-Info">
            <div class="container">
                <h2><br><br>Supplier Information</h2><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($supplier_result->num_rows > 0) {
                            while ($supplier_row = $supplier_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $supplier_row['supplier_name'] . "</td>";
                                echo "<td>" . $supplier_row['supplier_address'] . "</td>";
                                echo "<td>" . $supplier_row['contact_number'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No suppliers found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section id="customer-Info">
            <div class="container">
                <h2><br><br>Customer Information</h2><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($customer_result->num_rows > 0) {
                            while ($customer_row = $customer_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $customer_row['customer_name'] . "</td>";
                                echo "<td>" . $customer_row['email'] . "</td>";
                                echo "<td>" . $customer_row['shipping_address'] . "</td>";
                                echo "<td>" . $customer_row['contact_number'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No customers found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
</div>

    <section>
			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>


						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->
        

<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>
<script src="admin.js"></script>
</body>
</html>
