<?php
require("classcafter.php");
$caftr = new cafter();
$db = $caftr->connect();
session_start();

$_SESSION['user'];

if (!(isset($_SESSION['user']))) {
    header('location:../controls/login.php');
}
$id = $_SESSION['user']['id'];
$totalprice = 0;
$selectedid = 0;
$calfrom = @$_REQUEST['calfrom'];
$calto = @$_REQUEST['calto'];
//  var_dump($calfrom );
//  var_dump($calto);

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
            <a href="#"><img src="img/logo.jpg" alt=""></a>
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
                    <li><a href="#">Arabic</a></li>
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
                <li><a href="./shoping-cart.php">Shoping Cart</a>

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
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Arabic</a></li>
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
                            <li><a href="./index.php">Home</a></li>
                            <li><a href="./shoping-cart.php">Shoping Cart</a>

                            </li>
                            <li><a href="./myorder.php">My Orders</a></li>

                            <li class="active"><a href="./contact.php">Contact</a></li>
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

                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="search.html">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
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


    <section class="breadcrumb-section set-bg" data-setbg="">
        <div class="container">
            <div class="row">

                <!-- <div>welcome</div>          -->



            </div>
        </div>
        </div>
        </div>
    </section>

    <div class="container">

        <form method="Post" action='myorder.php'>
            <div class="container row ">
                <label class="form-label">From :</label>
                <input type="date" class="col-5" name="calfrom" class="form-control">
                <label class="form-label">To:</label>

                <input type="date" class="col-5" name="calto" class="form-control">
            </div>
            <br><br>
            <input type="submit" name="confirm" value="Confirm" class="btn btn-warning">
        </form>
    </div>




    <div class="contact-form spad">
        <div class="container">
            <div class="row">



                <?php

                if (isset($_REQUEST['confirm']) || isset($_REQUEST['key']) == "true") {

                    $select_query = "
    SELECT orders.date,orders.action,orders.order_id,orders.amount,orders.status,SUM(orders.amount*orders.price) 
    from users,orders,useer_order WHERE users.id=useer_order.user_id and 
    orders.order_id=useer_order.order_id AND orders.amount >0
    and orders.date>=?
    and orders.date<=?
    and users.id=? GROUP BY  orders.date; ";
                    $stm = $db->prepare($select_query);
                    $resobj = $stm->execute([$calfrom, $calto, $id]);
                    echo
                    "<table class='table table-dark table-hover'>
                   <th scope='col'>Order Date</th> 
                        <th scope='col'>Price</th> 
                        <th scope='col'>Status</th> 
                        <th scope='col'>Action</th>";
                    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                        $totalprice += $row["SUM(orders.amount*orders.price)"];

                        echo "<tr><td><a href='myorder.php?adddetail=true&key=true&datee={$row["date"]}&calfrom={$calfrom}&calto={$calto}'>
                    <input type='button' value='+'></a>
                     {$row["date"]}</td>
                     
                            <td>{$row["SUM(orders.amount*orders.price)"]}EGP</td>
                                                            <td> {$row['status']}</td>
                                                             <td>" .
                            (($row['status'] == 'Processing') ?
                                "<a  class='btn btn-danger' href='cancelOrder.php?date={$row['date']}&id={$row['order_id']}&user_id={$id}&amount={$row['amount']}'>Cancel</a>"
                                : '')
                            . "
                                </td>
                            
                            </tr>";
                        // var_dump($row);
                    }
                    echo "</table>";
                } else {



                    $select_query = "
    SELECT orders.date,orders.action,orders.order_id,orders.amount,orders.status,SUM(orders.amount*orders.price) 
    from users,orders,useer_order WHERE users.id=useer_order.user_id and 
    orders.order_id=useer_order.order_id AND orders.amount >0  
    and users.id=?
    GROUP BY  orders.date; ";
                    $stm = $db->prepare($select_query);


                    $resobj = $stm->execute([$id]);
                    echo   "<table class='table table-dark table-hover'>
                    <th scope='col'>Order Date</th> 
                        <th scope='col'>Price</th> 
                        <th scope='col'>Status</th> 
                        <th scope='col'>Action</th>
                    ";
                    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                        $totalprice += $row["SUM(orders.amount*orders.price)"];
                        echo "<tr><td><a href='myorder.php?adddetail=true&datee={$row["date"]}&calfrom={$calfrom}&calto={$calto} '>
         <input type='button' value='+'></a>
          {$row["date"]}</td>
                 <td>{$row["SUM(orders.amount*orders.price)"]}EGP</td>
                     <td> {$row['status']}</td>
                                                             <td>" .
                            (($row['status'] == 'Processing') ?
                                "<a  class='btn btn-danger' href='cancelOrder.php?date={$row['date']}&id={$row['order_id']}&user_id={$id}&amount={$row['amount']}'>Cancel</a>"
                                : '')
                            . "
                                </td>
                 </tr>
                 
                 ";
                    }
                    echo "</table>";
                }
                $datee = @$_REQUEST['datee'];
                // $uid = 13;
                $select_query = "
    SELECT users.id,users.name, orders.order_name,orders.amount,orders.price,
orders.date,orders.pictur from users,orders,useer_order WHERE users.id=useer_order.user_id and
 orders.order_id=useer_order.order_id AND orders.amount >0 
AND orders.date=? and users.id=?;
    ";
                $stm = $db->prepare($select_query);
                if (isset($_REQUEST['adddetail'])) {

                    $resobj = $stm->execute([$datee, $id]);
                    echo "<table class='table table-dark table-hover'>";
                    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr><div style='display:inline-block; width: 15%;height: 200px;text-align: center;margin-left: 10px;'>     
            <br><img src='../admin/files/{$row["pictur"]}' width=100px height=100px  ><br>
           <span name=span>  {$row["order_name"]} </span><br>
           <span name=spapi>amount {$row["amount"]} </span><br>
           <span name=spapi>price {$row["price"]} EGP </span><br>
                   </div></tr>";
                        //var_dump($row);
                    }

                    echo "</table>";

                    // $f = 0;
                }

                echo "total price" . $totalprice;

                ?>
                <!-- </div> -->
            </div>
        </div>
    </div>
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 Assuit</li>
                            <li>Phone: +20 1188.188.888</li>
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
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
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
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>