<?php
require("classcafter.php");
$caftr = new cafter();
$db = $caftr->connect();
static $totalprice = 0;
static $totpricefinal = 0;
$userids = @$_REQUEST['userids'];
$prodids = @$_REQUEST['prodids'];
include '../controls/database.php';
session_start();
$_SESSION['user'];
if (!isset($_SESSION['user'])) {
    header('location:../controls/login.php');
};
$emailuser = $_SESSION['user']['email'];
if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
    session_destroy();
    header('location:../controls/login.php');
}
?>
<?php
try {
    $select_query = "select * from apiorder where id_user=? and product_id=?";
    $stm = $db->prepare($select_query);
    $resobj = $stm->execute([$userids, $prodids]);
    $select_prod = "select * from products where  id=?";
    $stmprod = $db->prepare($select_prod);
    $resobj = $stmprod->execute([$prodids]);
    $rowprod = $stmprod->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    return $e;
}
if (isset($_GET['add'])) {


    $rowprodf = 0;
    $rowprods = $rowprod["amount"];
    //$rowprods=7;
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {


        $amount = (int)$row['amount'];
        if ($amount < $rowprods) {
            $rowprodf = (int)$rowprods - $amount - 1;
            $amount = (int)$row['amount'] + 1;
            $update_query = "update apiorder set amount=?,productamount=? where id_user=? and product_id=? and action='' ";
            $stmt = $db->prepare($update_query);
            $resobj = $stmt->execute([$amount, $rowprodf, $userids, $prodids]);
        } else {
            echo '<script>alert("we are sorry countaty finished")</script>';
            break;
        };
    }
}

//echo $rowprodf;

if (isset($_GET['dele'])) {

    try {
        $select_query = "select * from apiorder where id_user=? and product_id=?";
        $stm = $db->prepare($select_query);
        $resobj = $stm->execute([$userids, $prodids]);
    } catch (Exception $e) {
        return $e;
    }
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        if ($row['amount'] > 1) {
            $rowp = (int)$row['productamount'] + 1;
            $amount = (int)$row['amount'] - 1;
            try {
                $update_query = "update apiorder set amount=?,productamount=? where id_user=? and product_id=? and action!='canceld' ";
                $stmt = $db->prepare($update_query);
                $resobj = $stmt->execute([$amount, $rowp, $userids, $prodids]);
            } catch (Exception $e) {
                return $e;
            }
        } else {
            echo '<script>alert("If You Want To cancel order Click Cancel ")</script>';
            break;
        };
    }
}

if (isset($_GET['remov'])) {

    $canceldamount = $rowprod["amount"];
    try {
        $select_query = "select * from apiorder where id_user=? and product_id=?";
        $stm = $db->prepare($select_query);
        $resobj = $stm->execute([$userids, $prodids]);
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

            $update_query = "update apiorder set action='canceld',amount=0,productamount=? where id_user=? and product_id=? ";
            $stmt = $db->prepare($update_query);
            $resobj = $stmt->execute([$canceldamount, $userids, $prodids]);
        }
    } catch (Exception $e) {
        return $e;
    }
}
try{
$select_query = "select * from users where email=? ";
$stmt = $db->prepare($select_query);
$resobj = $stmt->execute([$emailuser]);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $userid = $row["id"];
    $room = $row["room_id"];
}
}catch(Exception $e){
    return $e;
}




?>




<?php


if (isset($_REQUEST['conferm'])) {
    try{
    $notetextarea = @$_REQUEST['notetextarea'];
    //var_dump($notetextarea);
    $insertorder = "insert INTO orders (order_id,order_name,date,price,notes, pictur,product_id,action,amount) 
    SELECT apiorder.orderid, apiorder.ordername,apiorder.date,apiorder.orderprice,'$notetextarea',apiorder.orderimag,
     apiorder.product_id,apiorder.action,apiorder.amount FROM apiorder;";
    $stmts = $db->prepare($insertorder);
    $resobj = $stmts->execute();
    $insertusrorde = "insert INTO useer_order 
    SELECT apiorder.id_user,apiorder.orderid  FROM apiorder;";
    $stmtord = $db->prepare($insertusrorde);
    $resobj = $stmtord->execute();
    $update_prod = "update products p1 INNER JOIN 
    apiorder p2 on p1.id=p2.product_id
    set p1.amount=p2.productamount ";
    $stmt = $db->prepare($update_prod);
    $resobj = $stmt->execute();
    $deletapi = "delete from apiorder;";
    $stmtor = $db->prepare($deletapi);
    $resobj = $stmtor->execute();
        // header('location:index.php');
    }catch (Exception $e){
        return $e;
    }

}

?>








<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Ogani Template" />
    <meta name="keywords" content="Ogani, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Cafeteria_Project</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/nice-select.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css" />
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
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
            <a href="#"><img src="img/logo.png" alt="" /></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="shoping-cart.html"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>


            </ul>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="" />
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Aabic</a></li>
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
                <li><a href="./myorder.php">My Orders</a></li>

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
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> Cafeteria@gmail.com</li>
                                <li>Free Shipping for all Order of EGP 99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
                                <a href="https://www.pinterest.com/"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="" />
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
                        <a href="./index.html"><img src="img/logo.jpg" width="150px" height="150px" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="./index.php">Home</a></li>
                            <li>
                                <a href="./shoping-cart.php">Shoping Cart</a>
                            </li>
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

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories"></div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="search.php">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?" />
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
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/org.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody>



                                <?php



                                $select_query = "select * from apiorder where id_user=? ";
                                $stm = $db->prepare($select_query);
                                $resobj = $stm->execute([$userid]);
                                while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row['action'] != 'canceld') {
                                        $totalprice = ($row['amount'] * $row['orderprice']);
                                        $totpricefinal += $totalprice;
                                        echo "<tr>
<td class=shoping__cart__item>
    <img src=../admin/files/{$row['orderimag']} alt='' width=220px/>
     

    
</td>
<td>   
{$row['ordername']}
</td>
<td>
<input type='text' value={$row['amount']}>
</td>
<td>
<a href='shoping-cart.php?add=true&userids={$row['id_user']}&prodids={$row['product_id']}'>
<input type='button' value='+'></a></td>
<td> <a href='shoping-cart.php?dele=true&userids={$row['id_user']}&prodids={$row['product_id']}'>
<input type='button' value='-'></a></td>
 <td> <a href=' shoping-cart.php?remov=true&userids={$row['id_user']}&prodids={$row['product_id']}'>
<input type='button' value='cancel' name='delet'></a>

</td>
<td >EGP {$totalprice}</td></tr>";
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="./index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <!-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a> -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Notes</h5>
                            <form action="shoping-cart.php?conferm=true" method="post">
                                <input type="text" style="width: 300px; height: 250px" width="300px" placeholder=" Enter your comment " name="notetextarea" />




                                <hr />






                                <h5 class="">Room</h5>
                                <?php
                                $select_query = "select * from rooms where id=?";
                                $stmt = $db->prepare($select_query);
                                $resobj = $stmt->execute([$room]);
                                echo "<select class='hero__search__form' aria-label=Default select example>";
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option>{$row['name']}</option>";
                                }
                                echo "</select>";

                                ?>


                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span>EGP <?php echo "{$totpricefinal}"; ?></span></li>
                        </ul>
                        <!-- <a href="shoping-cart.php?conferm=true" class="primary-btn">PROCEED TO CHECKOUT</a>-->
                        <input type="submit" value="PROCEED TO CHECKOUT" class="primary-btn">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html "><img src="img/logo.jpg " alt=" " /></a>
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
                            <li><a href="# ">About Us</a></li>
                            <li><a href="# ">About Our Shop</a></li>
                            <li><a href="# ">Secure Shopping</a></li>
                            <li><a href="# ">Delivery infomation</a></li>
                            <li><a href="# ">Privacy Policy</a></li>
                            <li><a href="# ">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="# ">Who We Are</a></li>
                            <li><a href="# ">Our Services</a></li>
                            <li><a href="# ">Projects</a></li>
                            <li><a href="# ">Contact</a></li>
                            <li><a href="# ">Innovation</a></li>
                            <li><a href="# ">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>
                            Get E-mail updates about our latest shop and special offers.
                        </p>
                        <form action="# ">
                            <input type="text " placeholder="Enter your mail " />
                            <button type="submit " class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="# "><i class="fa fa-facebook"></i></a>
                            <a href="# "><i class="fa fa-instagram"></i></a>
                            <a href="# "><i class="fa fa-twitter"></i></a>
                            <a href="# "><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <i class="fa fa-heart" aria-hidden="true "></i>
                            </p>
                        </div>
                        <div class="footer__copyright__payment">
                            <img src="img/payment-item.png " alt=" " />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

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