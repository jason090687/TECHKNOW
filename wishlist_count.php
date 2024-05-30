<?php
session_start();
$wishlist_count = isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0;
echo json_encode(['count' => $wishlist_count]);
?>