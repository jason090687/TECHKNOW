<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chichart - Intro Page</title>
    <link rel="stylesheet" href="css/intro.css">
</head>

<body>
    <div class="container">
        <div class="left-panel" id="customerPanel">
            <h1>Customer</h1>
            <p>Explore our wide range of products and shop with confidence.</p>
            <button onclick="navigateTo('customer')">Explore as Customer</button>
        </div>
        <div class="right-panel" id="sellerPanel">
            <h1>Seller</h1>
            <p>Join our platform and start selling your products to a vast audience.</p>
            <button onclick="navigateTo('seller')">Explore as Seller</button>
        </div>
    </div>
    <script src="js/intro.js"></script>
</body>

</html>