<?php
//path: product\product-detail.php
include_once 'model/product.php';
if (isset($_GET['product']) && isset($_GET['name'])) {
 $id   = $_GET['product'];
 $name = $_GET['name'];
 $data = get_product_by_id_and_name($id, $name);

 if (!$data) {
  $error_uri = 'http://localhost/404.php';
  echo "<script type='text/javascript'>document.location.href='{$error_uri}';</script>";
 } else {
  $product = $data;
 }
 // print_r($product);
} else {
 $error_uri = 'http://localhost/404.php';
 echo "<script type='text/javascript'>document.location.href='{$error_uri}';</script>";
}
$page_title = $_GET['target'];

?>

<!-- HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
    integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="assets/css/product/product-detail.css" />
</head>

<body>
    <section class="product-detail-wrapper grid wide">
        <!-- bread-crumb -->
        <div class="bread-crumb-wrapper">
            <a href="index.php" class="bread-crumb-item">Home</a>
            <img src="assets/img/arrow-right-s-line.svg" alt="thuong-mai-dien-tu" class="bread-crumb-icon" />
            <a href="?target=product" class="bread-crumb-item">Product</a>
            <img src="assets/img/arrow-right-s-line.svg" alt="thuong-mai-dien-tu" class="bread-crumb-icon" />
            <a href="#"
                class="bread-crumb-item <?php echo $page_title === 'product-detail' ? 'current-page' : '' ?>">Product
                Detail</a>
            <button class="previous-page__button">
                <img src="assets/img/arrow-left.svg" alt="thuong-mai-dien-tu" />
            </button>
        </div>
        <!-- product-detail -->
        <div class="product-wrapper">
            <input type="hidden" name="id" value="<?php echo $product['id'] ?>" class="product-id">
            <!-- bigest image -->
            <div class="current-image">
                <img src="<?php echo $product['img'] ?>" alt="thuong-mai-dien-tu" />
            </div>
            <div class="detail">
                <h1 class="product-name"><?php echo $product['name'] ?></h1>
                <div class="rate">
                    <img src="assets/img/rate/rate=5.svg" alt="thuong-mai-dien-tu" />
                    <span class="rate-count">(1032)</span>
                </div>
                <div class="price">
                    <span class="current-price"
                        data-price='<?php echo "{$product['current_price']}" ?>'><?php echo number_format($product['current_price'], 0, ',', '.') . 'đ' ?></span>
                    <?php
if ($product['discount_percent'] > 0) {
 echo '<span class="old-price">' . number_format($product['before_price'], 0, ',', '.') . 'đ</span>';
}
?>
                </div>
                <?php
if ($product['discount_percent'] > 0) {
 echo '<div class="discount-percent">disc.' . $product['discount_percent'] . '%</div>';
}
?>
                <div class="product-quantitys"><?php echo $product['quantity'] ? $product['quantity'] : '0' ?></div>
                <div class="quantity">
                    <button class="decrease">-</button>
                    <span class="quantity-num">1</span>
                    <button class="increase">+</button>
                </div>
                <div class="choice">
                    <select name="size">
                        <?php
$size = explode(',', $product['size']);
if ($size) {
 echo "<option value='{$size[0]}'>Size</option>";
 foreach ($size as $item) {
  echo '<option value="' . $item . '">' . $item . '</option>';
 }
} else {
 echo "<option value=''>Size</option>";
}
?>
                    </select>
                    <select name="color">
                        <?php
$color = explode(',', $product['color']);
if ($color[0] === '') {
 echo "<option value=''>Color</option>";
} else {
 echo "<option value='{$color[0]}'>Color</option>";
 foreach ($color as $item) {
  echo '<option value="' . $item . '">' . $item . '</option>';
 }}
?>
                    </select>
                </div>
                <span class="total-before-text">total: </span><span class="total">0</span>
                <div class="action">
                    <button class="add-to-cart__button">
                        <img src="assets/img/cart.svg" alt="thuong-mai-dien-tu" />
                        Add to cart
                    </button>
                    <button class="buy-now__button">Buy now</button>
                </div>
                <div class="shop">
                    <?php
if (!$product['seller']) {
 echo "<div class='shop-avatar'>
                                        <img src='https://res.cloudinary.com/ninhnam/image/upload/v1667999661/e-commerce/toppng.com-anonymous-freetoedit-anonymous-hacker-mask-240x316_g1frmt.png'
                                        alt='thuong-mai-dien-tu' />
                                    </div>
                                    <h3 class='shop-name'>Admin / Moderator</h3>";
} else {
 echo "<div class='shop-avatar'>
                                   <a href='#'><img src='{$product['seller']['img']}'alt='thuong-mai-dien-tu' /></a>
                                    </div>
                                <h3 class='shop-name'>{$product['seller']['name']}</h3>";
}
?>
                    <button class="chat__button">
                        <img src="assets/img/question-answer-fill.svg" alt="thuong-mai-dien-tu" />
                        Chat
                    </button>
                </div>
            </div>
        </div>

        <!-- <div class="product-images">
            <ul class="images-list">
                <li class="image-item selected">
                    <img src="assets/img/products/image 14.png" alt="thuong-mai-dien-tu" />
                </li>
                <li class="image-item">
                    <img src="assets/img/products/image 36.png" alt="thuong-mai-dien-tu" />
                </li>
                <li class="image-item">
                    <img src="assets/img/products/image 37.png" alt="thuong-mai-dien-tu" />
                </li>
            </ul>
        </div> -->

        <?php
if (isset($product['description_and_specs'])) {
 $desc_and_specs = json_decode($product['description_and_specs'], true);
 // var_dump($product['description_and_specs']);
 // var_dump(json_decode($product['description_and_specs']));
 // var_dump(json_last_error());
 // var_dump(json_last_error_msg());
 // description
 if ($desc_and_specs) {
  if ($desc_and_specs['description'] !== null) {
   $desc_lines = explode(',', $desc_and_specs['description']);
   echo "<div class='product-description'>
                        <h2 class='title'>Description</h2>
                        <ul class='desc-list'>";
   foreach ($desc_lines as $line) {
    echo "<li class='desc-item'>$line</li>";
   }
   echo "</ul>
                            </div>";

  }
  //specs
  if ($desc_and_specs['specs'] !== null) {
   $specs_lines = explode(',', $desc_and_specs['specs']);
   echo "<div class='product-specs'>
                        <h2 class='title'>Specs</h2>
                        <ul>";
   foreach ($specs_lines as $line) {
    echo "<li>$line</li>";
   }
   echo "</ul>
                            </div>";
  }
 }
}

?>
        <!-- review -->
        <div class="product-review">
            <div class="header">
                <h3>Review</h3>
                <img src="assets/img/rate/rate=5.svg" alt="thuong-mai-dien-tu" />
                (2)
            </div>
            <main>
                <div class="reviewer">
                    <div class="name-and-date">Mehdi, 13 May 2022</div>
                    <div class="rate">
                        <img src="assets/img/rate/rate=5.svg" alt="thuong-mai-dien-tu" />
                    </div>
                    <span class="content">
                        Mini design, light weight, smooth trackball.
                    </span>
                </div>
                <div class="reviewer">
                    <div class="name-and-date">Mehdi, 13 May 2022</div>
                    <div class="rate">
                        <img src="assets/img/rate/rate=5.svg" alt="thuong-mai-dien-tu" />
                    </div>
                    <span class="content">
                        Mini design, light weight, smooth trackball.
                    </span>
                </div>
            </main>
        </div>
        <div class="mobile action">
            <span class="price">0</span>
            <button class="add-to-cart__button medium">
                <img src="assets/img/cart.svg" alt="thuong-mai-dien-tu" />
                Add to cart
            </button>
            <button class="buy-now__button medium">Buy now</button>
        </div>
    </section>
    <!-- JS -->
    <script>
    const totalProducts = document.querySelector('.product-quantitys');
    const quantityDisplay = document.querySelector('span.quantity-num');
    const increaseQuantityBtn = document.querySelector('button.increase');
    const decreaseQuantityBtn = document.querySelector('button.decrease');
    const total = document.querySelector('span.total');
    const price = document.querySelector('span.current-price');
    const mobileTotal = document.querySelector('.mobile > span.price');
    if (+totalProducts.textContent === 0) {
        increaseQuantityBtn.disabled = true;
        decreaseQuantityBtn.disabled = true;
        quantityDisplay.textContent = 0;
        total.textContent = 'Hết hàng';
        mobileTotal.textContent = 'Hết hàng';
    }

    function updateTotal() {
        if (+totalProducts.textContent !== 0) {
            total.textContent = new Intl.NumberFormat('vi-VI', {
                maximumSignificantDigits: 3,
                currency: 'VND',
                style: 'currency',

            }).format(+price.dataset.price * +quantityDisplay.textContent);
            mobileTotal.textContent = new Intl.NumberFormat('vi-VI', {
                maximumSignificantDigits: 3,
                currency: 'VND',
                style: 'currency',

            }).format(+price.dataset.price * +quantityDisplay.textContent);
        }
    }
    updateTotal();

    increaseQuantityBtn.addEventListener('click', () => {
        if (+quantityDisplay.textContent < +totalProducts.textContent) {
            quantityDisplay.textContent = +quantityDisplay.textContent + 1;
        }
        updateTotal();
    });

    decreaseQuantityBtn.addEventListener('click', () => {
        if (+quantityDisplay.textContent > 1) {
            quantityDisplay.textContent = +quantityDisplay.textContent - 1;
        }
        updateTotal();
    });
    // console.log(document.cookie)
    </script>
    <script src='assets/js/product-detail.js'></script>
</body>