<title>Home</title>
<?php
include_once 'model/pagination.php';
include_once 'model/product.php';
 ?>

<!-- Begin-Main -->
<link rel="stylesheet" href="./assets/css/home/home.css" />
<link rel="stylesheet" href="./assets/css/home/responsive.css" />
<main>
    <nav class="categories-nav">
        <div class="nav-item ice">
            <button>
                <img src="./assets/img/main/categories/camera-fill.svg" alt="" />
            </button>
            <span class="category-title">Camera</span>
        </div>
        <div class="nav-item mint">
            <button>
                <img src="./assets/img/main/categories/gamepad-fill.svg" alt="" />
            </button>
            <span class="category-title">Console</span>
        </div>
        <div class="nav-item mint">
            <button>
                <img src="./assets/img/main/categories/CPU-fill.svg" alt="" />
            </button>
            <span class="category-title">CPU</span>
        </div>
        <div class="nav-item coral">
            <button>
                <img src="./assets/img/main/categories/smartphone-fill.svg" alt="" />
            </button>
            <span class="category-title">Gadget</span>
        </div>
        <div class="nav-item apricot">
            <button>
                <img src="./assets/img/main/categories/headphone-fill.svg" alt="" />
            </button>
            <span class="category-title">Gadget Accessoris</span>
        </div>
        <div class="nav-item rose">
            <button>
                <img src="./assets/img/main/categories/hard-drive-2-fill.svg" alt="" />
            </button>
            <span class="category-title">Harddisk</span>
        </div>
        <div class="nav-item lavender">
            <button>
                <img src="./assets/img/main/categories/computer-fill.svg" alt="" />
            </button>
            <span class="category-title">Monitor</span>
        </div>
        <div class="nav-item ice">
            <button>
                <img src="./assets/img/main/categories/mouse-fill.svg" alt="" />
            </button>
            <span class="category-title">Mouse</span>
        </div>
        <div class="nav-item valina">
            <button>
                <img src="./assets/img/main/categories/tv-fill.svg" alt="" />
            </button>
            <span class="category-title">TV</span>
        </div>
        <div class="nav-item lavender">
            <button>
                <img src="./assets/img/main/categories/router-fill.svg" alt="" />
            </button>
            <span class="category-title">Router</span>
        </div>
    </nav>
    <div class="products grid wide">
        <div class="row">
            <?php
            $products = get_product_by_limit(8);
            // print_r( $data['pagination']);
            foreach($products as $product) {
                if($product['discount_percent'] > 0) {
                    $before_price = true;
                    $current_price = $product['price'] - ($product['price'] * $product['discount_percent'] / 100);
                } else {
                    $before_price = false;
                    $current_price = $product['price'];
                }
              echo "<div class='col c-6 m-3 l-3 product'>
                        <a href='?rdt=product-detail&product={$product['id']}&name={$product['name']}' class='product-item'>
                            <div class='product-image'>
                                <img src='{$product['img']}' alt='product-img' />
                            </div>
                            <div class='product-info'>
                                <div class='product-name'>
                                    <span>{$product['name']}</span>
                                </div>
                                <div class='product-price'>
                                    <button class='price'>
                                        <span class='current-price'>".number_format($current_price, 0, ',', '.')."đ</span>".
                                        ($before_price ? "<span class='before-price'>{$product['price']}</span>" : '').
                                    "</button>".
                                    ($before_price ? "<div class='discount'>disc.{$product['discount_percent']}%</div>" : '').
                                "</div>
                            </div>
                        </a>
                    </div>";
            }
            ?>

        </div>
    </div>
    <div class="hot-products">
        <div class="wrapper">
            <div class="tabs grid wide">
                <div class="row">
                    <div class="tab active col c-6 m-3 l-3 product">
                        Most popular items
                    </div>
                    <div class="tab col c-6 m-3 l-3 product">
                        Most trending items
                    </div>
                </div>
            </div>
            <div class="products grid wide">
                <div class="row">
                    <div class="col c-6 m-3 l-3 product">
                        <a href="#" class="product-item">
                            <div class="product-image">
                                <img src="./assets/img/main/hot products/image 5.svg" alt="product-img" />
                            </div>
                            <div class="product-info">
                                <div class="product-name">
                                    <span>PS4 OP Stick Bonus USB
                                        Change Cable White</span>
                                </div>
                                <div class="product-price">
                                    <button class="price">
                                        <span class="current-price">$100</span>
                                        <span class="before-price">$150</span>
                                    </button>
                                    <div class="discount">
                                        disc.17%
                                    </div>
                                </div>
                            </div>
                            <div class="rate">
                                <img src="./assets/img/rate/rate=5.svg" alt="" />
                                <span class="total-rate">(1,234)</span>
                            </div>
                        </a>
                    </div>
                    <div class="col c-6 m-3 l-3 product">
                        <a href="#" class="product-item">
                            <div class="product-image">
                                <img src="./assets/img/main/hot products/image 6.svg" alt="product-img" />
                            </div>
                            <div class="product-info">
                                <div class="product-name">
                                    <span>PS4 OP Stick Bonus USB
                                        Change Cable White</span>
                                </div>
                                <div class="product-price">
                                    <button class="price">
                                        <span class="current-price">$100</span>
                                        <span class="before-price">$150</span>
                                    </button>
                                    <div class="discount">
                                        disc.17%
                                    </div>
                                </div>
                            </div>
                            <div class="rate">
                                <img src="./assets/img/rate/rate=4.svg" alt="" />
                                <span class="total-rate">(1,234)</span>
                            </div>
                        </a>
                    </div>
                    <div class="col c-6 m-3 l-3 product">
                        <a href="#" class="product-item">
                            <div class="product-image">
                                <img src="./assets/img/main/hot products/image 7.svg" alt="product-img" />
                            </div>
                            <div class="product-info">
                                <div class="product-name">
                                    <span>PS4 OP Stick Bonus USB
                                        Change Cable White</span>
                                </div>
                                <div class="product-price">
                                    <button class="price">
                                        <span class="current-price">$100</span>
                                        <span class="before-price">$150</span>
                                    </button>
                                </div>
                            </div>
                            <div class="rate">
                                <img src="./assets/img/rate/rate=4.svg" alt="" />
                                <span class="total-rate">(1,234)</span>
                            </div>
                        </a>
                    </div>
                    <div class="col c-6 m-3 l-3 product">
                        <a href="#" class="product-item">
                            <div class="product-image">
                                <img src="./assets/img/main/hot products/image 9.svg" alt="product-img" />
                            </div>
                            <div class="product-info">
                                <div class="product-name">
                                    <span>PS4 OP Stick Bonus USB
                                        Change Cable White</span>
                                </div>
                                <div class="product-price">
                                    <button class="price">
                                        <span class="current-price">$100</span>
                                        <span class="before-price">$150</span>
                                    </button>
                                    <div class="discount">
                                        disc.17%
                                    </div>
                                </div>
                            </div>
                            <div class="rate">
                                <img src="./assets/img/rate/rate=4.svg" alt="" />
                                <span class="total-rate">(1,234)</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="latest-products">
        <div class="grid wide products">
            <div class="label">Latest Product</div>
            <div class="row">
                <button class="next">
                    <img src="./assets/img/main/icons-svg/arrow-left.svg" alt="" />
                </button>
                <?php
            $products = get_product_lastest_by_limit(4);
            // print_r( $data['pagination']);
            foreach($products as $product) {
                if($product['discount_percent'] > 0) {
                    $before_price = true;
                    $current_price = $product['price'] - ($product['price'] * $product['discount_percent'] / 100);
                } else {
                    $before_price = false;
                    $current_price = $product['price'];
                }
              echo "<div class='col c-6 m-3 l-3 product'>
              <a href='?rdt=product-detail&product={$product['id']}&name={$product['name']}' class='product-item'>
                            <div class='product-image'>
                                <img src='{$product['img']}' alt='product-img' />
                            </div>
                            <div class='product-info'>
                                <div class='product-name'>
                                    <span>{$product['name']}</span>
                                </div>
                                <div class='product-price'>
                                    <button class='price'>
                                        <span class='current-price'>".number_format($current_price, 0, ',', '.')."đ</span>".
                                        ($before_price ? "<span class='before-price'>".number_format($product['price'], 0, ',', '.')."đ</span>" : '').
                                    "</button>".
                                    ($before_price ? "<div class='discount'>disc.{$product['discount_percent']}%</div>" : '').
                                "</div>
                            </div>
                        </a>
                    </div>";
            }
            ?>
            </div>
        </div>
    </div>
</main>
<!-- End-Main -->

<script>

</script>