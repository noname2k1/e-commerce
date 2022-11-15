<?php
include_once '../model/profile.php';
include_once '../model/user.php';
// change includes file of admin
$target = '';
if (isset($_GET['target'])) {
 $target = $_GET['target'];
} else {
 $target = 'user';
}

//load profile
$profile = [];
if (isset($_SESSION['id'])) {
 $profile                = get_profile_by_userid($_SESSION['id']);
 $_SESSION['profile_id'] = $profile['id'];
 $_SESSION['name']       = $profile['name'];
 $_SESSION['img']        = $profile['img'];
}

// handle logout
if (isset($_POST['logout']) && $_POST['logout'] == true) {
 user_logout('sign-in.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Management</title>
    <link rel="icon" href="../assets/img/Chomerce - logo.svg" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/base.css" />
    <link rel="stylesheet" href="../assets/css/admin/index.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <style>
    .nav-link.active {
        font-weight: 600;
        color: var(--bg-primary) !important;
    }

    .nav-link i {
        margin-right: 4px;
    }

    .nav-link.user::after {
        display: none;
    }

    .nav-link.user>p {
        margin-bottom: 0;
        margin-right: 4px;
    }

    .nav-link.show>p {
        margin-bottom: 0;
        margin-right: 4px;
        font-weight: 600;
    }

    .nav-link>.avatar {
        width: 40px;
        height: 40px;
    }

    .nav-link>.avatar {
        width: 40px;
        height: 40px;
    }

    .nav-link>.avatar img {
        width: 100%;
        height: 100%;
    }
    </style>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg bg-info">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $target === 'user' ? 'active' : '' ?>" aria-current="page"
                            href="?target=user"><i class="bi bi-people-fill"></i>user</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $target === 'product' ? 'active' : '' ?>" href="?target=product"><i
                                class="bi bi-cart-fill"></i>product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $target === 'category' ? 'active' : '' ?>" href="?target=category"><i
                                class="bi bi-grid-1x2-fill"></i>category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $target === 'brand' ? 'active' : '' ?>" href="?target=brand"><i
                                class="bi bi-stars"></i>brand</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $target === 'profile' ? 'active' : '' ?>" href="?target=profile"><i
                                class="bi bi-person-badge-fill"></i>profile</a>
                    </li>
                </ul>
                <div class="dropdown ms-auto">
                    <a class="nav-link dropdown-toggle d-flex align-items-center user" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <p><?php echo $_SESSION['name'] ?> (<?php echo $_SESSION['role'] ?>) </p>
                        <div class="avatar">
                            <img src="<?php echo $_SESSION['img'] ?>" alt="thuong-mai-dien-tu">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-start">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST">
                                <input type="hidden" name="logout" value="true">
                                <button type='submit' class="dropdown-item">logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>