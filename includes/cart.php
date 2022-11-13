<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
        integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/base.css" />
    <link rel="stylesheet" href="./assets/css/grid/grid.css" />
    <link rel="stylesheet" href="./assets/css/cart/cart.css" />
</head>

<body>
    <section id="cart-container" class="grid wide">
        <h1>
            <button class="mobile previous-page__button">
                <img src="./assets/img/arrow-left.svg" alt="thuong-mai-dien-tu" /></button>Shop cart
        </h1>
        <ul class="products-list">
            <!-- <li class="product-item">
                    <div class="no-product">No product found in shop cart</div>
                </li> -->
            <li class="product-item">
                <input type="checkbox" name="product" />
                <img src="./assets/img/products/image 14.png" alt="product" />
                <div class="product-info">
                    <h3 class="product-name">Product name</h3>
                    <div class="action">
                        <p class="product-price">$100</p>
                        <div class="quantity">
                            <button class="btn-quantity decrease">-</button>
                            <span class="num">1</span>
                            <button class="btn-quantity increase">+</button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="end-cart__element"></div>
        <div class="total">
            <span class="total-num">total: $99999999</span>
            <button class="btn btn-primary">Process to payment</button>
        </div>
    </section>
</body>

</html>
