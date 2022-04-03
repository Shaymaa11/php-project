<?php
require("classcafter.php");
$caftr = new cafter();
$db = $caftr->connect();
$name = @$_REQUEST["name"];
$price = @$_REQUEST['price'];
$id = @$_REQUEST['id'];
$pic = @$_REQUEST['pic'];
include '../controls/database.php';
session_start();
$_SESSION['user'];
$emailuser = $_SESSION['user']['email'];

if (!isset($_SESSION['user'])) {
    header('location:../controls/login.php');
};

if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    session_destroy();
    header('location:../controls/login.php');
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cafeteria_Project</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.jpg" width="100px" height="100px" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="shoping-cart.html"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>


            </ul>

        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li>
                        <a href="#">Arabic</a>
                    </li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <?php
            $myimage = $_SESSION['user']['image'];
            if (@$myimage == '') {
                echo '<img class="rounded-circle article-img" style="width:80px;" src="../controls/images/default-avatar.png">';
                echo  "<div class='ms-2 d-block' >" . $_SESSION['user']['name'] . "</div>";
            } else {
                // echo '<img class="rounded-circle article-img" style="width:80px;" src="./uploaded_image/' . $row['image'] . '">';
                echo '<img class="rounded-circle article-img" style="width:80px;" src="../controls/uploaded_image/' . $myimage . '">';

                echo  "<div class='ms-2 d-block' >" . $_SESSION['user']['name'] . "</div>";
            }
            ?>

            <div class="header__top__right__auth">
                <a href="index.php?logout=<?php echo @$user_id; ?>" class="delete-btn">Logout</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li>
                    <a href="./shoping-cart.php">Shoping Cart</a>

                </li>
                <li>
                    <a href="./myorder.php">My Orders</a>
                </li>
                <!-- <li><a href="./blog.html">Blog</a></li> -->
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
            <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
            <a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
            <a href="https://www.pinterest.com/"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> Cafeteria@gmail.com</li>
                <li>Free Shipping for all Order of EGP 99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> Cafeteria@gmail.com</li>
                                <li>Free Shipping for all Order of EGP 99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
                                <a href="https://www.pinterest.com/"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li>
                                        <a href="#">Arabic</a>
                                    </li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <?php
                            $myimage = $_SESSION['user']['image'];
                            if (@$myimage == '') {
                                echo '<img class="rounded-circle article-img" style="width:80px;" src="../controls/images/default-avatar.png">';
                                echo  "<div class='ms-2 d-block' >" . $_SESSION['user']['name'] . "</div>";
                            } else {
                                // echo '<img class="rounded-circle article-img" style="width:80px;" src="./uploaded_image/' . $row['image'] . '">';
                                echo '<img class="rounded-circle article-img" style="width:80px;" src="../controls/uploaded_image/' . $myimage . '">';

                                echo  "<div class='ms-2 d-block' >" . $_SESSION['user']['name'] . "</div>";
                            }
                            ?>

                            <div class="header__top__right__auth">
                                <a href="index.php?logout=<?php echo @$user_id; ?>" class="delete-btn">Logout</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">

                    <div class="header__logo">

                        <a href="./index.html"><img src="img/logo.jpg" width="100px" height="100px" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="./shoping-cart.php">Shoping Cart</a>
                            </li>
                            <!-- <li><a href="./blog.html">Blog</a></li> -->
                            <li><a href="./myorder.php">My Orders</a></li>
                            <li><a href="./contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="shoping-cart.html"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <?php
    $select_query = "select * from users where email=? ";
    $stmt = $db->prepare($select_query);
    $resobj = $stmt->execute([$emailuser]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $userid = $row["id"];
        $room = $row["room_id"];
    }


    ?>
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="col-md-12">
                            <div class="latest-product__text">
                                <h4>Latest Order </h4>
                                <p>&nbsp;</p>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <?php

                                        $select_quers = "select * FROM users,orders,useer_order WHERE users.id=useer_order.user_id AND orders.amount >0
                                                        AND orders.order_id=useer_order.order_id AND users.email=? ORDER by orders.date LIMIT 3";
                                        $stmtm = $db->prepare($select_quers);
                                        $resobj = $stmtm->execute([$emailuser]);
                                        while ($row = $stmtm->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<a href='#' class='latest-product__item'>
                                                <div class='latest-product__item__pic'>
                                                    <img src='../admin/files/{$row["pictur"]}' alt=''>
                                                </div>
                                                <div class='latest-product__item__text'>
                                                    <h5>{$row["order_name"]}</h5>
                                                </div>
                                            </a>";
                                        }
                                        ?>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php

                                        $select_quers = "select * FROM users,orders,useer_order WHERE users.id=useer_order.user_id
                                                        AND orders.order_id=useer_order.order_id AND users.email=? ORDER by orders.date LIMIT 3,3";
                                        $stmtm = $db->prepare($select_quers);
                                        $resobj = $stmtm->execute([$emailuser]);
                                        while ($row = $stmtm->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<a href='#' class='latest-product__item'>
                                                <div class='latest-product__item__pic'>
                                                    <img src='../admin/files/{$row["pictur"]}' alt=''>
                                                </div>
                                                <div class='latest-product__item__text'>
                                                    <h5>{$row["order_name"]}</h5>
                                                   
                                                </div>
                                            </a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="search.php?id=<?php "{$id}" ?>">

                                <select class="arrow_carrot-down" aria-label=".form-select-lg example" name="selct">

                                    <option>all</option>
                                    <?php
                                    $select_query = "select * from categories ";
                                    $stm = $db->prepare($select_query);
                                    $resobj = $stm->execute();
                                    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<option>{$row["name"]}</option> ";
                                    }

                                    ?>
                                </select>
                              
                                <input type="text" placeholder="What do yo u need?" name="key">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+20 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/hero/cov.png">
                        <div class="hero__text">
                            <span>FRUIT FRESH</span>
                            <h2 style="color: rgb(245, 241, 235);">Drinks <br />100% Freesh</h2>
                            <p style="color: rgb(245, 241, 235);">Free Pickup and Delivery Available</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/fresh.jpg">
                            <h5><a href="#">Fresh Juice</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/ho4.jpg">
                            <h5>
                                <a href="#">Nescafe Black</a>
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/hot2.jpg">
                            <h5><a href="#">Hot Tea</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/b1.jpg">
                            <h5>
                                <a href="#">Coca-cola</a>
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/hotd.jpg">
                            <h5>
                                <a href="#">Hot Drinks</a>
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/col.jpg">
                            <h5>
                                <a href="#">Cool Drinks</a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".hot">Hot Drinks</li>
                            <li data-filter=".fresh-juice">Fresh Juice</li>
                            <li data-filter=".cool-drinks">Cool Drinks</li>
                            <li data-filter=".frozen">Frozen</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php

                $select_query = "select * from products where amount>0";
                $stmt = $db->prepare($select_query);
                $resobj = $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    if ($row["category_id"] == 1) {
                        echo    "<div class='col-lg-3 col-md-4 col-sm-6 mix hot'>
                <div class='featured__item'>
                    <div class='featured__item__pic set-bg' data-setbg=../admin/files/{$row["pictur"]}>
                        <ul class='featured__item__pic__hover'>
                            <li><a href='#'><i class='fa fa-heart'></i></a></li>
                            <li><a href='#'><i class='fa fa-retweet'></i></a></li>
                            <li><a href='addcart.php?name={$row["name"]}&pic={$row["pictur"]}&prodid={$row["id"]}&
                            price={$row["price"]}&userid={$userid}&categoryid={$row["category_id"]}'>
                            <i class='fa fa-shopping-cart'></i></a></li>
                        </ul>
                    </div>
                    <div class='featured__item__text'>
                        <h6>
                            <a href='#'> {$row["name"]} </a>
                        </h6>
                        <h5>{$row["price"]}</h5>
                    </div>
                </div>
            </div>";
                    } else if ($row["category_id"] == 2) {
                        echo    "<div class='col-lg-3 col-md-4 col-sm-6 mix cool-drinks frozen'>
                        <div class='featured__item'>
                            <div class='featured__item__pic set-bg' data-setbg=../admin/files/{$row["pictur"]}>
                                <ul class='featured__item__pic__hover'>
                                    <li><a href='#'><i class='fa fa-heart'></i></a></li>
                                    <li><a href='#'><i class='fa fa-retweet'></i></a></li>
                                    <li><a href='addcart.php?name={$row["name"]}&pic={$row["pictur"]}&prodid={$row["id"]}
                                    &price={$row["price"]}&userid={$userid}&categoryid={$row["category_id"]}'>
                                    <i class='fa fa-shopping-cart'></i></a></li>
                                </ul>
                            </div>
                            <div class='featured__item__text'>
                                <h6>
                                    <a href='#'> {$row["name"]} </a>
                                </h6>
                                <h5>{$row["price"]}</h5>
                            </div>
                        </div>
                    </div>";
                    } else if ($row["category_id"] == 3) {
                        echo    "<div class='col-lg-3 col-md-4 col-sm-6 mix fresh-juice'>
                                <div class='featured__item'>
                                    <div class='featured__item__pic set-bg' data-setbg=../admin/files/{$row["pictur"]}>
                                        <ul class='featured__item__pic__hover'>
                                            <li><a href='#'><i class='fa fa-heart'></i></a></li>
                                            <li><a href='#'><i class='fa fa-retweet'></i></a></li>
                                            <li><a href='addcart.php?name={$row["name"]}&pic={$row["pictur"]}&prodid={$row["id"]}
                                            &price={$row["price"]}&userid={$userid}&categoryid={$row["category_id"]}'>
                                            <i class='fa fa-shopping-cart'></i></a></li>
                                        </ul>
                                    </div>
                                    <div class='featured__item__text'>
                                        <h6>
                                            <a href='#'> {$row["name"]} </a>
                                        </h6>
                                        <h5>{$row["price"]}</h5>
                                    </div>
                                </div>
                            </div>";
                    } else {

                        echo    "<div class='col-lg-3 col-md-4 col-sm-6 mix '>
                                    <div class='featured__item'>
                                        <div class='featured__item__pic set-bg' data-setbg=../admin/files/{$row["pictur"]}>
                                            <ul class='featured__item__pic__hover'>
                                                <li><a href='#'><i class='fa fa-heart'></i></a></li>
                                                <li><a href='#'><i class='fa fa-retweet'></i></a></li>
                                                <li><a href='addcart.php?name={$row["name"]}&pic={$row["pictur"]}&prodid={$row["id"]}
                                                &price={$row["price"]}&userid={$userid}&categoryid={$row["category_id"]}'>
                                                <i class='fa fa-shopping-cart'></i></a></li>
                                            </ul>
                                        </div>
                                        <div class='featured__item__text'>
                                            <h6>
                                                <a href='#'> {$row["name"]} </a>
                                            </h6>
                                            <h5>{$row["price"]}</h5>
                                        </div>
                                    </div>
                                </div>";
                    }
                }
                ?>

            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/b1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Coca-Cola</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/cof.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Coffee</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/tea.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Tea</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/juc2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Strawberry Juice</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lem.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Lemon Juice</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/orange.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Orange Juice</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/hot3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Caffee Latte</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/juc.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Watermelon</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/juc1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Fresh Pomegranate Juice </h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/tea.webp" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Jasmine Tea</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/juce.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Kiwi Juice</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lem.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Lemon Juice</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/cof.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Coffee</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/b1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6> Coca-Cola</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/tea.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Tea</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/juc2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Strawberry Juice</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lem.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Lemon Juice</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/orange.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Orange Juice</h6>
                                        <span>EGP 30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.jpg" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 Assuit</li>
                            <li>Phone: +20 11.188.888</li>
                            <li>Email: Cafeteria@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.facebook.com/"><i class="fa fa-instagram"></i></a>
                            <a href="https://www.facebook.com/"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.facebook.com/"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> <i class="fa fa-heart" aria-hidden="true"></i>

                            </p>
                        </div>
                        <div class=" footer__copyright__payment "><img src="img/payment-item.png " alt=" "></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js "></script>
    <script src="js/bootstrap.min.js "></script>
    <script src="js/jquery.nice-select.min.js "></script>
    <script src="js/jquery-ui.min.js "></script>
    <script src="js/jquery.slicknav.js "></script>
    <script src="js/mixitup.min.js "></script>
    <script src="js/owl.carousel.min.js "></script>
    <script src="js/main.js "></script>



</body>

</html>