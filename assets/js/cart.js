document.addEventListener('DOMContentLoaded', function () {
    let total = $('.total-num>span.num');
    let totalNum = parseInt($('.total-num>span.num').text().split(' ')[0]) || 0;
    let checkedCartItems = $('input[type="checkbox"][name="productid"]');
    const productsList = $('ul.products-list');
    const headerCart = $('.header-cart');

    function format_currency(num, currency) {
        return new Intl.NumberFormat('vi-VI', {
            style: 'currency',
            currency,
        }).format(num);
    }
    checkedCartItems.each(function (index, item) {
        $(item).on('change', function () {
            if ($(item).is(':checked')) {
                totalNum += +$(item).data('price');
            } else {
                totalNum -= +$(item).data('price');
            }
            total.text(format_currency(totalNum, 'VND'));
        });
    });

    $(document).on('click', '.delete-cart-item', function () {
        const headerCartNum = (cartItems) => {
            if (!cartItems) {
                return `
                <a href="?target=cart">
                    <img src="./assets/img/header/shopping-cart-2-line.svg" alt="cart-button" />
                </a>`;
            } else {
                if (Array.isArray(cartItems)) {
                    return `
                <a href="?target=cart">
                    <img src="./assets/img/header/shopping-cart-2-line.svg" alt="cart-button" />
                </a>
                <div class='cart-products-num'>${cartItems.length}</div>`;
                }
            }
        };
        const emptyNotice = `<li class='product-item no-product'>
        <div class='no-product'>No product found in shop cart. <a href='?target=product'>Add product.</a></div>
        </li>`;
        const renderCartItem = (cartItem) => {
            const rawPrice = cartItem.price * cartItem.quantity;
            const price = format_currency(rawPrice, 'VND');
            return `<li class='product-item'>
            <input type='checkbox' name='productid' value='${cartItem['cart_item_id']}' data-price='${rawPrice}'/>
            <img src='${cartItem['img']}' alt='thương-mại-điện-tử-e-commerce' />
            <div class='product-info'>
                <h3 class='product-name'>${cartItem['name']}</h3>
                <div class='infor'>
                    <p class='product-price'>${price}</p>
                    <div class='quantity'>
                        <span class='num'>x${cartItem['quantity']}</span>
                    </div>
                </div>
            </div>
            <button class='delete-cart-item' data-cart-item-id='${cartItem['cart_item_id']}'>X</button>
        </li>`;
        };
        //delete cart item
        let opts = {
            url: 'includes/cart/delete-cart-item.php',
            data: {
                cartItemId: $(this).data('cart-item-id'),
            },
            success: function (cartItems) {
                const parsecartItems = JSON.parse(cartItems);
                if (!parsecartItems) {
                    productsList.html(emptyNotice);
                } else {
                    if (Array.isArray(parsecartItems)) {
                        productsList.html(
                            parsecartItems
                                .map((cartItem) => renderCartItem(cartItem))
                                .join('')
                        );
                    }
                }
                toastr.warning(
                    'Delete cart item successfully',
                    'DELETE CART ITEM',
                    {
                        timeOut: 2000,
                    }
                );
                // toastr.options.closeButton = true;
                headerCart.html(headerCartNum(parsecartItems));
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
            },
        };
        $.post(opts);
    });
});
