<?php
require("classcafter.php");
$caftr = new cafter();
$db = $caftr->connect();
session_start();

$_SESSION['user'];

if (!(isset($_SESSION['user']))) {
    header('location:../controls/login.php');
}
//id of user
$id = $_SESSION['user']['id'];

$selectedid = @$_REQUEST['selectedid'] ?? @$_REQUEST['selectedidreq'];
$calfrom = @$_REQUEST['calfrom'] ?? '2022-03-19';;
$calto = @$_REQUEST['calto'] ?? date_create()->format('Y-m-d H:i:s');

?>
<html>

<head>
    <title> checks </title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- <nav class="navbar navbar-light" style="background-color: #e3f2fd;"> -->

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">
                <div class="ms-3">

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

                </div>
            </a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../admin_cafeterai/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./allproduct.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./addcategory.php">Add Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin_cafeterai/manualOrder.php">Manual Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controls/allUsers.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./checks.php">Checks</a>
                </li>
            </ul>
        </div>

    </nav>
    <br><br>
    <br>
    <br><br>

    <div class="container mt-3">

        <form method="Post" action='checks.php'>
            <div class="container m-1">
                From :<input type="date" name="calfrom" class="form-control">
                To: <input type="date" name="calto" class="form-control"><br>
            </div>


            <div class="hero__categories">
                <div class="hero__categories__all">

                    <i class="fa fa-bars"></i>

                </div><br><br>
                <select name="selectedid" class="form-control">
                    <option value=0>All User</option>


                    <?php
                    $select_query = "select * from users ";
                    $stm = $db->prepare($select_query);
                    $resobj = $stm->execute();


                    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

                        echo "<option value={$row["id"]} name=id>{$row["name"]}</option> ";
                    }

                    ?>
                </select>
                <input type="submit" value="Confirm" class="btn btn-secondary">
        </form>
    </div>

    <?php
    if ($selectedid == 0) {
        $select_query = "select users.name ,users.id,SUM(orders.amount) from users,orders,useer_order WHERE
    users.id=useer_order.user_id and orders.order_id=useer_order.order_id
    and orders.date>=?
   and orders.date<=?
    GROUP BY users.name;";
        $stm = $db->prepare($select_query);
        $resobj = $stm->execute([$calfrom, $calto]);

        echo "<table class='table table-dark table-hover'>
        <th scope='col-3'>Name</th>
         <th scope='col-3'>Amount</th>";
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

            echo "<tr><td>
                
                <a href='checks.php?add=true&selectedidreq={$row["id"]}&selectedid=0'>
                <input type='button' value='+'></a>
                {$row["name"]}</td>
                        <td>{$row["SUM(orders.amount)"]}</td></tr>";
        }
        echo "</table>";
    } else {
        $select_query = "select users.name ,users.id,SUM(orders.amount) from users,orders,useer_order WHERE
            users.id=useer_order.user_id and orders.order_id=useer_order.order_id and users.id=?
            and orders.date >=?
           and orders.date<=?
           GROUP BY users.name;";
        $stm = $db->prepare($select_query);
        $resobj = $stm->execute([$selectedid, $calfrom, $calto]);
        echo "<table class='table table-dark table-hover'>
        <th scope='col-3'>Name</th>
         <th scope='col-3'>Amount</th>";
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

            echo "<tr><td>
                          
                <a href='checks.php?add=true&selectedidreq={$row["id"]}&calfrom={$calfrom}&calto={$calto}'>
                <input type='button' value='+'></a>
                           {$row["name"]}</td>
                                   <td>{$row["SUM(orders.amount)"]}</td></tr>";
        }
        echo "</table>";
    }

    $select_query = "
                   SELECT orders.date ,SUM(orders.amount*orders.price) 
                   from users,orders,useer_order WHERE users.id=useer_order.user_id and 
                   orders.order_id=useer_order.order_id AND orders.action !='canceld'  
                   and orders.date>=?
                   and orders.date<=?
                   and users.id=? GROUP BY orders.date; ";
    $stm = $db->prepare($select_query);
    $id = @$_REQUEST['selectedidreq'];
    if (isset($_REQUEST['add'])) {
        $resobj = $stm->execute([$calfrom, $calto,$id]);
        echo "<table class='table table-dark table-hover'>
        <th scope='col-3'>Date</th>
         <th scope='col-3'>Amount</th>";
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td><a href='checks.php?add=true&adddetail=true&selectedidreq={$id}&datee={$row["date"]}&selectedid={$selectedid}&calfrom={$calfrom}&calto={$calto}'>
                        <input type='button' value='+'></a>
                         {$row["date"]}</td>
                                <td>{$row["SUM(orders.amount*orders.price)"]}EGP</td></tr>";
            // var_dump($row);
        }
        echo "</table>";
    }

    $datee = @$_REQUEST['datee'];
    $uid = @$_REQUEST['selectedidreq'];
    $select_query = "
                SELECT users.id,users.name, orders.order_name,orders.amount,orders.price,
            orders.date,orders.pictur from users,orders,useer_order WHERE users.id=useer_order.user_id and
             orders.order_id=useer_order.order_id AND orders.action !='canceld'
            AND orders.date=? and users.id=?;
                ";
    $stm = $db->prepare($select_query);
    if (isset($_REQUEST['adddetail'])) {

        $resobj = $stm->execute([$datee, $uid]);
        echo "<table class='table table-dark table-hover'>";
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><div style='display:inline-block; width: 15%;height: 200px;text-align: center;margin-left: 10px;'>     
                        <br><img src='../admin/files/{$row["pictur"]}' width=150px height=150px  ><br>
                       <span name=span>  {$row["order_name"]} </span><br>
                       <span name=spapi>amount {$row["amount"]}$ </span><br>
                       <span name=spapi>price {$row["price"]}$ </span><br>
                               </div></tr>";
            //var_dump($row);
        }

        echo "</table>";
    }


    ?>


    </div>
</body>


</html>