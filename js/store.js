//Add to Cart
$('.working-add-to-cart').on('click', function (e) {
	alert("Your chosen product is successfully added to cart");
	let product_id = $(this).attr('data-id');
	let product_name = $(this).attr('data-productname');
	let price = $(this).attr('data-price');
	$.post(
	  'ajax/cart.php',
	  {
		request : 'addToCart',
		product_id : product_id,
		product_name : product_name,
		price : price
	  },
	  function(data, status){
		let m = JSON.parse(data);
		console.log(m);
		if(m['success'] === 'success'){
		  alert('Your chosen product has been added to cart.');
		}
	  }
	)});
  
// PLace an order
$('.order-submit').on('click', function (e) {
	$.post(
	  'ajax/cart.php',
	  {
		request : 'placeOrder'
	  },
	  function(data, status){
		let m = JSON.parse(data);
		console.log(m);
		if(m['success'] === 'success'){
		  alert('Your order has been successfully processed');
		}
	  }
	)});

  

// Add event listeners to the "Home" and "All Categories" links
var homeLink = document.getElementById("home-link");
var allCategoriesLink = document.getElementById("all-categories-link");

homeLink.addEventListener("click", function() {
  // Redirect to index.php when Home link is clicked
  window.location.href = "index.php";
});

allCategoriesLink.addEventListener("click", function() {
  // Redirect to index.php when Home link is clicked
  window.location.href = "store.php";
});



