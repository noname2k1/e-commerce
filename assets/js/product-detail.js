document.addEventListener('DOMContentLoaded', function () {
    const addToCartButton = $('.add-to-cart__button');
    let quantity = $('span.quantity-num').text();
    const productid = $('input[name="id"].product-id').val();
    const headerCart = $('.header-cart');
    $('span.quantity-num').on('DOMSubtreeModified', function () {
        quantity = $('span.quantity-num').text();
    });
    const headerCartNum = (cartItems) => {
        return `
        <a href="?target=cart">
            <img src="./assets/img/header/shopping-cart-2-line.svg" alt="cart-button" />
        </a>
        <div class='cart-products-num'>${cartItems.length}</div>`;
    };
    addToCartButton.click(function () {
        let data = {
            quantity,
            productid,
        };
        const opts = {
            url: 'includes/cart/add-to-cart.php',
            data,
            // dataType: 'json',
            success: function (cartItems) {
                const parseCartItems = JSON.parse(cartItems);
                if (parseCartItems) {
                    toastr.success('Add to cart successfully', 'ADD TO CART', {
                        timeOut: 2000,
                    });
                    headerCart.html(headerCartNum(parseCartItems));
                } else
                    toastr.error('Add to cart failed', 'ADD TO CART', {
                        timeOut: 2000,
                    });
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            },
        };
        $.post(opts);
    });
});
