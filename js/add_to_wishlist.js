
function updateWishlistCount() {
    $.ajax({
        url: 'wishlist_count.php',
        type: 'GET',
        success: function(response) {
            var result = JSON.parse(response);
            $('#wishlist-quantity').text(result.count);
        }
    });
}

$(document).ready(function() {
    // Update the wishlist count on page load
    updateWishlistCount();

    // Update the wishlist count whenever an item is added to the wishlist
    $('.add-to-wishlist').on('click', function(e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var product_name = $(this).data('productname');
        var price = $(this).data('price');

        $.ajax({
            url: 'add_to_wishlist.php',
            type: 'POST',
            data: {
                product_id: product_id,
                product_name: product_name,
                price: price
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message);
                    updateWishlistCount();
                } else if (result.status === 'info') {
                    alert(result.message);
                } else {
                    alert(result.message);
                }
            }
        });
    });
});

