<div class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
<i class="fa fa-shopping-cart"></i>
<span>Your Cart</span>
<div class="qty"><?=(!empty($_SESSION['products']) ? count($_SESSION['products']) : "0");?></div>
</a>
<div class="cart-dropdown">
<div class="cart-list">
    <?php
    (int)$subtotal = 0;
    if(!empty($_SESSION['products'])){
        foreach($_SESSION['products'] as $product){
            $subtotal = $subtotal + (int)$product['price'];
    ?>
    <div class="product-widget">
    <div class="product-body">
        <h3 class="product-name"><?=$product['product_name'];?></h3>
        <h4 class="product-price"><span class="qty">1x</span>₱<?=$product['price'];?></h4>
    </div>
    <button class="delete" onclick="removeProduct(this)"><i class="fa fa-close"></i></button>
    </div>
    <?php
        }
    }
    else {
        echo "Empty Cart";
    }
    ?>
</div>
<div class="cart-summary">
    <small id="itemsSelected"><?=(!empty($_SESSION['products']) ? count($_SESSION['products']) : "0");?> Item(s) selected</small>
    <h5 id="subtotal">SUBTOTAL: ₱<?=$subtotal;?></h5>
</div>
<div class="cart-btns">
    <a href="#">View Cart</a>
    <a href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
</div>