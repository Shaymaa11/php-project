<?php


include '../controls/database.php';
session_start();
$_SESSION['user'];
// var_dump($user_id);
if (!isset($_SESSION['user'])) {
    header('location:../controls/login.php');
};




$stmt = "SELECT users.id,users.name,users.room_id,users.ext,orders.order_name,orders.pictur,orders.order_id,orders.price,orders.date,orders.action,orders.amount
FROM orders,useer_order,users
WHERE users.id = useer_order.user_id && orders.order_id = useer_order.order_id";
$stmt = $db->prepare($stmt);
$stmt->execute();


?>

<html>

<head>
    <title> ADMIN :: Manual Order</title>
    <style>
        body {
            background-color: #f3f4f7 !important;
        }

        td {
            padding: 10px;
        }

        .imgtable {
            width: 100px;
            height: 100px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">
                <div class="ms-3 d-block">
                    <?php
                    $myimage = $_SESSION['user']['image'];
                    if (@$row['image'] == '' && @$id) {
                        echo '<img class="rounded-circle article-img" style="width:80px;" src="../controls/images/default-avatar.png">';
                        echo  "<div class='ms-2 d-block' >" . $_SESSION['user']['name'] . "</div>";
                    } else {
                        echo '<img class="rounded-circle article-img" style="width:80px;" src="../controls/uploaded_image/' . $myimage . '">';
                        echo  "<div class='ms-2 d-block' >" . $_SESSION['user']['name'] . "</div>";
                    }
                    ?>
                </div>
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/allproduct.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/addcategory.php">Add Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manualOrder.php">Manual Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controls/allUsers.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/checks.php">Checks</a>
                </li>
            </ul>
        </div>
    </nav>

    <br><br>
    <br>
    <br><br>
    <div class="container mt-3">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Order Date</th>
                    <th>Name</th>
                    <th>Rooms</th>
                    <th>Ext.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                #fetching the record as associative array
            ?>
                <tr>

                    <td><?= $row["date"] ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row['room_id'] ?></td>
                    <td><?= $row['ext'] ?></td>
                    <td><?= $row['action'] ?></td>
                </tr>
                <tr>
                    <td colspan='7'>
                        <div>
                            <?php echo '<img class="article-img" style="width:80px;height:80px;" src="../admin/files/' . $row['pictur'] . '"> <br>'; ?>
                            <?= '<br><p>Total :' . $row['price'] .  '</p>'; ?>
                            <?= '<br><p>Amount :' . $row['amount'] .  '</p>'; ?>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    </table>
</body>

</html>