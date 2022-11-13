<?php
//path: includes\partials\header.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="./assets/img/Chomerce - logo.svg" type="image/x-icon" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" /> -->
    <!-- Bootstrap Font Icon CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="assets/css/base.css" />
    <link rel="stylesheet" href="assets/css/grid/grid.css" />
    <link rel="stylesheet" href="assets/css/partials.css" />
</head>

<body>
    <section id="header">
        <!-- Begin-Header -->
        <input type="checkbox" name="menu" id="mobile-menu" />
        <header>
            <div class="header-wrapper">
                <label class="mobile-menu" for="mobile-menu">
                    <img src="assets/img/header/menu-fill.svg" alt="menu" />
                </label>
                <label class="mobile-menu close" for="mobile-menu">
                    <img src="./assets/img/header/close-fill.svg" alt="menu" />
                </label>
                <!-- logo -->
                <div class="header-logo">
                    <a href="index.php">
                        <img src="./assets/img/Chomerce - logo.svg" alt="logo" />
                    </a>
                </div>
                <div class="header-search">
                    <input type="text" name="" id="" placeholder="search for anything" />
                    <img src="./assets/img/header/search-icon.svg" alt="search-icon" />
                </div>
                <!-- check user logged in -->
<?php
$curent_page_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (isset($_SESSION['name'])) {
 echo "<span class='user'><img src='./assets/img/user.svg' alt='thuong-mai-dien-tu'>Hi,{$_SESSION['name']}
                                 <div class='user-menu'>
                                    <ul>
                                        <li class='user-menu-item'>Account profile</li>
                                        <li class='user-menu-item'>Change password</li>
                                        <form method='POST' action='index.php'><input name='logout' type='submit' class='user-menu-item' value='LOGOUT'/></form>
                                    </ul>
                                </div>
                            </span>";
} else {
 echo "<a class='sign-in' href='sign-in.php?prevpage=" . $curent_page_url . "'>Sign in</a>";
}

?>
                <!-- cart -->
                <div class="header-cart">
                    <a href="?rdt=cart">
                        <img src="./assets/img/header/shopping-cart-2-line.svg" alt="cart-button" />
                    </a>
                </div>
            </div>
        </header>
        <div class="header-search mobile">
            <input type="text" name="" id="" placeholder="search for anything" />
            <img src="./assets/img/header/search-icon.svg" alt="search-icon" />
        </div>
        <!-- End-Header -->
        <nav class="categories-nav mobile">
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
                    <img src="./assets/img/main/categories/cpu-fill.svg" alt="" />
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

        <div class="mobile-navigation">
            <div class="nav-item home active">
                <svg width="25" height="24" viewBox="0 0 25 24" xmlns="http://www.w3.org/2000/svg" fill="transparent">
                    <path
                        d="M3.5 9L12.5 2L21.5 9V20C21.5 20.5304 21.2893 21.0391 20.9142 21.4142C20.5391 21.7893 20.0304 22 19.5 22H5.5C4.96957 22 4.46086 21.7893 4.08579 21.4142C3.71071 21.0391 3.5 20.5304 3.5 20V9Z"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.5 22V12H15.5V22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="category-title">Home</span>
            </div>
            <div class="nav-item">
                <svg width="25" height="24" viewBox="0 0 25 24" xmlns="http://www.w3.org/2000/svg" fill="#666666">
                    <path
                        d="M22.5 20H2.5V18H3.5V11.031C3.5 6.043 7.53 2 12.5 2C17.47 2 21.5 6.043 21.5 11.031V18H22.5V20ZM5.5 18H19.5V11.031C19.5 7.148 16.366 4 12.5 4C8.634 4 5.5 7.148 5.5 11.031V18ZM10 21H15C15 21.663 14.7366 22.2989 14.2678 22.7678C13.7989 23.2366 13.163 23.5 12.5 23.5C11.837 23.5 11.2011 23.2366 10.7322 22.7678C10.2634 22.2989 10 21.663 10 21Z" />
                </svg>
                <span class="category-title">Notifications</span>
            </div>
            <div class="nav-item">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="#666666" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M4.5 22C4.5 19.8783 5.34285 17.8434 6.84315 16.3431C8.34344 14.8429 10.3783 14 12.5 14C14.6217 14 16.6566 14.8429 18.1569 16.3431C19.6571 17.8434 20.5 19.8783 20.5 22H18.5C18.5 20.4087 17.8679 18.8826 16.7426 17.7574C15.6174 16.6321 14.0913 16 12.5 16C10.9087 16 9.38258 16.6321 8.25736 17.7574C7.13214 18.8826 6.5 20.4087 6.5 22H4.5ZM12.5 13C9.185 13 6.5 10.315 6.5 7C6.5 3.685 9.185 1 12.5 1C15.815 1 18.5 3.685 18.5 7C18.5 10.315 15.815 13 12.5 13ZM12.5 11C14.71 11 16.5 9.21 16.5 7C16.5 4.79 14.71 3 12.5 3C10.29 3 8.5 4.79 8.5 7C8.5 9.21 10.29 11 12.5 11Z" />
                </svg>

                <span class="category-title">Account</span>
            </div>
        </div>
    </section>
    <!-- JAVASCRIPT -->
    <script>
    const userSpan = document.querySelector('span.user');
    const userMenu = document.querySelector('.user-menu');

    if (userSpan) {
        userSpan.addEventListener('click', () => {
            userMenu.classList.add('on');
        });
    }
    document.addEventListener('click', (e) => {
        if (!e.target.closest('span.user')) {
            if (userMenu) {
                userMenu.classList.remove('on');
            }
        }
    });
    </script>