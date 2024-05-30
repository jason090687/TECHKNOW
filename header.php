 <!-- HEADER -->

 <header>

     <div id="top-header">
         <div class="container">
             <ul class="header-links pull-right">
                 <li><a href="#"><i class="fa-solid fa-peso-sign"></i> PHP</a></li>
                 <?php if (isset($_SESSION['user_id'])): ?>
                 <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                         <i class="fa fa-user-o"></i> My Account <i class="fa fa-caret-down"></i>
                     </a>
                     <ul class="dropdown-menu">
                         <li><a href="profile.php"><i class="fa fa-user-o"></i> My Profile</a></li>
                         <li><a href="orders.php"><i class="fa fa-check"></i> My Orders</a></li>
                         <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                     </ul>
                 </li>
                 <?php else: ?>
                 <li><a href="login.php"><i class="fa fa-user-o"></i> Login</a></li>
                 <?php endif; ?>
             </ul>
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
                                 <h2 class="chichartlogo">ChiChart</h2>
                             </a>
                         </div>
                     </div>
                     <!-- /LOGO -->

                     <!-- SEARCH BAR -->
                     <div class="col-md-6">
                         <div class="header-search">
                             <form id="search-form" action="search.php" method="GET">
                                 <div class="search-container">
                                     <input id="search-input" class="input" placeholder="Search here" name="query" />
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
                                 <a href="wishlist.php" id="wishlist-link">
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