<?php
session_start();
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    if (isset($_SESSION['wishlist'][$product_id])) {
        unset($_SESSION['wishlist'][$product_id]);
    }
}
header('Location: wishlist.php');
exit;
?>
