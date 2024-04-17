  <!-- HEADER -->
  <header>
    
    <div id="top-header">
      <div class="container">
        <ul class="header-links pull-left">
          <li><a href="#"><i class="fa fa-phone"></i> 0934-495-4327</a></li>
          <li><a href="#"><i class="fa fa-envelope-o"></i> chichart@email.com</a></li>
          <li><a href="#"><i class="fa fa-map-marker"></i> 9000 Lapasan Road</a></li>
        </ul>
        <ul class="header-links pull-right">
          <li><a href="#"><i class='fa-solid fa-peso-sign'></i>₱ PHP</a></li>
          <li><a href="#" onclick="openAccountMenu(event)"><i class="fa fa-user-o"></i> My Account</a></li>
          <div id="accountMenu" class="account-menu">
            <?php
            // Check if user is logged in
            if (isset($_SESSION['customer_id'])) {
              echo '<a href="profile.php">Profile</a>';
              echo '<a href="logout.php">Logout</a>';
            } else {
              echo '<a href="#" onclick="openProfilePopup()">Login</a>';
            }
            ?>
          </div>
        </ul>
      </div>
    </div>

<!-- LOGIN FORM -->

<div class="popup-overlay" id="profile-popup">
      <div class="popup-content form-container">
        <button class="close-btn" onclick="closeForm()">&times;</button>
        <h3 class="title" id="form-title">User Login</h3>

        <form class="form-horizontal" id="login-form" action="login.php" method="POST">
          <div class="form-group">
            <span class="input-icon"><i class="fa fa-user"></i></span>
            <input class="form-control" type="email" name="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <span class="input-icon"><i class="fa fa-lock"></i></span>
            <input class="form-control" type="password" name="password" placeholder="Password" required>
          </div>
          <span class="forgot-pass"><a href="#">Forgot Password?</a></span>
          <button type="submit" id="btn" class="btn signin">Login</button>
        </form>

        <form class="form-horizontal" id="registration-form" style="display: none;" action="register.php" method="POST">
          <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
          <?php } ?>

          <div class="form-group">
            <span class="input-icon"><i class="fa fa-user"></i></span>
            <input class="form-control" type="text" name="Full_Name" placeholder="Customer Name" required>
          </div>
          <div class="form-group">
            <span class="input-icon"><i class="fa fa-envelope"></i></span>
            <input class="form-control" type="email" name="Email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <span class="input-icon"><i class="fa fa-map-marker"></i></span>
            <input class="form-control" type="text" name="Address" placeholder="Shipping Address" required>
          </div>
          <div class="form-group">
            <span class="input-icon"><i class="fa fa-address-book"></i></span>
            <input class="form-control" type="text" name="Contact" placeholder="Contact Number" required>
          </div>
          <div class="form-group">
            <span class="input-icon"><i class="fa fa-lock"></i></span>
            <input class="form-control" type="password" name="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <span class="input-icon"><i class="fa fa-lock"></i></span>
            <input class="form-control" type="password" name="confirm_password" placeholder="Confirm Password" required>
          </div>
          <button type="submit" class="btn signin">Register</button>
        </form>

        <span class="user-signup" id="signup-link">Don't Have an Account? <a href="#" onclick="toggleForm()">Create Now</a></span>
      </div>
    </div>


    <!-- /LOGIN FORM -->

			  
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
									<a href="index.php"><img src="" alt=""></a>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

					<!-- SEARCH BAR -->
						<div class="col-md-6">
						<div class="header-search">
						<form id="search-form" action="store.php" method="GET">
							<div class="search-container">
							<input id="search-input" class="input" placeholder="Search here" name="s" />
							<button type="submit" class="search-btn" name="submit">Search</button>
							</div>
							<button id="delete-btn" class="delete-btn" type="button">X</button>
						</form>
						</div>
					</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								
							<!-- Wishlist -->
							<div>
									<a href="#" id="wishlist-link">
									<i id="wishlist-icon" class="fa fa-heart-o"></i>
									<span>Your Wishlist</span>
									<div id="wishlist-quantity" class="qty">0</div>
									</a>
								</div>
								<!-- /Wishlist -->

								<?php include('cart-dropdown.php');?>
									
								
								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
								
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->
        <!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
				<ul class="main-nav nav navbar-nav">
						<li><a href="index.php" id="home-link">Home</a></li>
						<?php
							// fetch categories
							$current_product_cat_slug = isset($_GET['cat']) ? $_GET['cat'] : "all";
							$cats = "SELECT * FROM categories";
							$cat_lists = $connect->query($cats);
							echo "<li class='".($current_product_cat_slug == "all" ? "active" : "")."'><a href='store.php'>Shop Now</a></li>";
							if ($cat_lists->num_rows > 0) {
								// output data of each cat
								while ($row = $cat_lists->fetch_assoc()) {
									echo "<li class='".($current_product_cat_slug == $row["category_slug"] ? "active" : "")."'><a href='store.php?cat=".$row["category_slug"]."'>".$row["category_name"]."</a></li>";
								}
							}
						?>
					</ul>
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->