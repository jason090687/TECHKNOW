(function($) {
	"use strict"

	// Mobile Nav toggle
	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})

	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});

	/////////////////////////////////////////

	// Products Slick
	$('.products-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: true,
			infinite: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
			responsive: [{
	        breakpoint: 991,
	        settings: {
	          slidesToShow: 2,
	          slidesToScroll: 1,
	        }
	      },
	      {
	        breakpoint: 480,
	        settings: {
	          slidesToShow: 1,
	          slidesToScroll: 1,
	        }
	      },
	    ]
		});
	});

	// Products Widget Slick
	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');

		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});

	/////////////////////////////////////////

	// Product Main img Slick
	$('#product-main-img').slick({
    infinite: true,
    speed: 300,
    dots: false,
    arrows: true,
    fade: true,
    asNavFor: '#product-imgs',
  });

	// Product imgs Slick
  $('#product-imgs').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
    asNavFor: '#product-main-img',
		responsive: [{
        breakpoint: 991,
        settings: {
					vertical: false,
					arrows: false,
					dots: true,
        }
      },
    ]
  });

	// Product img zoom
	var zoomMainProduct = document.getElementById('product-main-img');
	if (zoomMainProduct) {
		$('#product-main-img .product-preview').zoom();
	}

	/////////////////////////////////////////

	// Input number
	$('.input-number').each(function() {
		var $this = $(this),
		$input = $this.find('input[type="number"]'),
		up = $this.find('.qty-up'),
		down = $this.find('.qty-down');

		down.on('click', function () {
			var value = parseInt($input.val()) - 1;
			value = value < 1 ? 1 : value;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})

		up.on('click', function () {
			var value = parseInt($input.val()) + 1;
			$input.val(value);
			$input.change();
			updatePriceSlider($this , value)
		})
	});

	var priceInputMax = document.getElementById('price-max'),
			priceInputMin = document.getElementById('price-min');

	priceInputMax.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	priceInputMin.addEventListener('change', function(){
		updatePriceSlider($(this).parent() , this.value)
	});

	function updatePriceSlider(elem , value) {
		if ( elem.hasClass('price-min') ) {
			console.log('min')
			priceSlider.noUiSlider.set([value, null]);
		} else if ( elem.hasClass('price-max')) {
			console.log('max')
			priceSlider.noUiSlider.set([null, value]);
		}
	}

	// Price Slider
	var priceSlider = document.getElementById('price-slider');
	if (priceSlider) {
		noUiSlider.create(priceSlider, {
			start: [1, 999],
			connect: true,
			step: 1,
			range: {
				'min': 1,
				'max': 999
			}
		});

		priceSlider.noUiSlider.on('update', function( values, handle ) {
			var value = values[handle];
			handle ? priceInputMax.value = value : priceInputMin.value = value
		});
	}

})(jQuery);

function openAccountMenu(event) {
    event.preventDefault();
    var accountMenu = document.getElementById('accountMenu');
    accountMenu.style.display = (accountMenu.style.display === 'block') ? 'none' : 'block';
  }
  
  function removeProduct(button) {
	// Get the parent product-widget element to remove
	const productWidget = button.parentNode;
  
	// Remove the product-widget element
	productWidget.remove();
  
	// Decrease the quantity in the cart
	const qtyElement = document.querySelector('.dropdown-toggle .qty');
	const currentQty = parseInt(qtyElement.textContent);
	const newQty = currentQty - 1;
	qtyElement.textContent = newQty > 0 ? newQty : '';
  
	// Update the cart summary
	const summaryItems = document.getElementById('itemsSelected');
	const summarySubtotal = document.getElementById('subtotal');
	const numItems = document.querySelectorAll('.product-widget').length;
	summaryItems.textContent = numItems === 0 ? '' : numItems === 1 ? '1 Item selected' : numItems + ' Items selected';
	summarySubtotal.textContent = numItems === 0 ? '' : 'SUBTOTAL: ₱' + calculateSubtotal().toFixed(0);
  }
  
  function calculateSubtotal() {
	// Get all product price elements
	const productPrices = document.querySelectorAll('.product-price');
  
	// Calculate the subtotal based on the prices and quantities
	let subtotal = 0;
	productPrices.forEach(function (priceElement) {
	  const qtyElement = priceElement.querySelector('.qty');
	  const qtyText = qtyElement.textContent;
	  const qty = parseInt(qtyText);
  
	  const priceText = priceElement.textContent.replace('₱', '').replace(',', '');
	  const price = parseFloat(priceText);
  
	  subtotal += price * qty;
	});
  
	return subtotal;
  }

  $(document).ready(function() {
	$('.store-pagination li').click(function() {
	  $('.store-pagination li').removeClass('active');
	  $(this).addClass('active');
	});
  });
  
    // JavaScript code snippet for wishlist button
    document.addEventListener("DOMContentLoaded", function() {
		var wishlistIcon = document.getElementById("wishlist-icon");
		var wishlistQuantity = document.getElementById("wishlist-quantity");
		var productWishlistButtons = document.querySelectorAll(".add-to-wishlist");
  
		// Event listener for the wishlist button in the product section
		productWishlistButtons.forEach(function(button) {
		  button.addEventListener("click", function() {
			var productWishlistIcon = this.querySelector("i");
  
			// Toggle the wishlist status
			if (productWishlistIcon.classList.contains("fa-heart-o")) {
			  productWishlistIcon.classList.remove("fa-heart-o"); // Add the filled heart icon
			  productWishlistIcon.classList.add("fa-heart");
			  productWishlistIcon.style.color = "red"; // Change the heart icon color to red
			  wishlistQuantity.textContent = parseInt(wishlistQuantity.textContent) + 1; // Increase the wishlist quantity
			} else {
			  productWishlistIcon.classList.remove("fa-heart"); // Add the empty heart icon
			  productWishlistIcon.classList.add("fa-heart-o");
			  productWishlistIcon.style.color = ""; // Reset the heart icon color
			  wishlistQuantity.textContent = parseInt(wishlistQuantity.textContent) - 1; // Decrease the wishlist quantity
			}
		  });
		});
	  });
  
  function openAccountMenu(event) {
	event.stopPropagation();
	document.getElementById('accountMenu').classList.toggle('show');
  }
  
  function openProfilePopup() {
	document.getElementById('profile-popup').style.display = 'block';
  }
  
  function closeProfilePopup() {
	document.getElementById('profile-popup').style.display = 'none';
  }
  
  // Close the account menu when clicking outside of it
  window.addEventListener('click', function(event) {
	if (!event.target.matches('.account-menu')) {
	  var accountMenu = document.getElementById('accountMenu');
	  if (accountMenu.classList.contains('show')) {
		accountMenu.classList.remove('show');
	  }
	}
  });


  function closeForm() {
	document.getElementById('profile-popup').style.display = 'none';
	
  }
  
  function toggleForm() {
	var loginForm = document.getElementById("login-form");
	var registrationForm = document.getElementById("registration-form");
	var formTitle = document.getElementById("form-title");
  
	if (registrationForm.style.display === "none") {
	  // Switch to registration form
	  loginForm.style.display = "none";
	  registrationForm.style.display = "block";
	  formTitle.innerHTML = "Register";
	} else {
	  // Switch to login form
	  loginForm.style.display = "block";
	  registrationForm.style.display = "none";
	  formTitle.innerHTML = "User Login";
	}
  }


     // Function to handle adding a product to the cart
	 function addToCart(button) {
        var productId = button.getAttribute('data-id');
        var productName = button.getAttribute('data-productname');
        var price = button.getAttribute('data-price');

        // Perform AJAX request to add the product to the cart
        // You need to implement the server-side functionality for adding the product to the cart

        // Update the cart items dynamically
        var cartItemsList = document.getElementById('cart-items-list');
        var cartItemCount = document.getElementById('cart-item-count');
        var itemsSelected = document.getElementById('itemsSelected');
        var subtotal = document.getElementById('subtotal');

        // Create a new cart item HTML element
        var productWidget = document.createElement('div');
        productWidget.className = 'product-widget';
        productWidget.innerHTML = `
            <div class="product-img">
                <img src="./img/product-image.jpg" alt="${productName}">
            </div>
            <div class="product-body">
                <h3 class="product-name"><a href="#">${productName}</a></h3>
                <h4 class="product-price"><span class="qty">1x</span>₱${price}</h4>
            </div>
            <button class="delete" onclick="removeProduct(this)"><i class="fa fa-close"></i></button>
        `;

        // Append the new cart item to the cart items list
        cartItemsList.appendChild(productWidget);

        // Update the cart item count
        cartItemCount.innerText = parseInt(cartItemCount.innerText) + 1;

        // Update the items selected count and subtotal
        itemsSelected.innerText = cartItemCount.innerText + ' Item(s) selected';
        subtotal.innerText = 'SUBTOTAL: ₱' + (parseFloat(subtotal.innerText.replace(/[^0-9.-]+/g, "")) + parseFloat(price)).toFixed(2);
    }


// Function to remove a product from the cart
function removeProduct(button) {
    var productWidget = button.parentNode;
    productWidget.parentNode.removeChild(productWidget);

    // Update the cart item count
    var cartItemCount = document.getElementById('cart-item-count');
    var updatedItemCount = parseInt(cartItemCount.innerText) - 1;
    cartItemCount.innerText = updatedItemCount;

    // Update the items selected count
    var itemsSelected = document.getElementById('itemsSelected');
    itemsSelected.innerText = updatedItemCount - ' Item(s) selected';

    // Update the subtotal
    var subtotal = document.getElementById('subtotal');
    var productPrice = parseFloat(button.parentNode.getElementsByClassName('product-price')[0].innerText.replace(/[^0-9.-]+/g, ""));
    subtotal.innerText = 'SUBTOTAL: ₱' + (parseFloat(subtotal.innerText.replace(/[^0-9.-]+/g, "")) - productPrice).toFixed(2);
}


  
  

  