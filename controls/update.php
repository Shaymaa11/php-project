<?php

include 'database.php';

session_start();

if (!(isset($_SESSION['user']) && $_SESSION['user']['isadmin'])) {
    header('location:login.php');
}

@$error = json_decode($_GET['errors']);


$res = [];
//select the user
if (!empty($_GET['id']) && empty($_POST)) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM `users` WHERE `id`=:uid";
    $stmt = $db->prepare($query);
    $stmt->bindValue(":uid", $id);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin :: Edit User</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        p {
            color: red !important;
        }
        .have {
            color: blue !important;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">
                <div class="ms-3 d-block">
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
                    <a class="nav-link" href="../admin/allproduct.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin_cafeterai/manualOrder.php">Manual Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="allUsers.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/checks.php">Checks</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="form-container">
        <form action="validUpdate.php" method="post" enctype="multipart/form-data">
            <h3> Edit user </h3>
            <input class="box" type="hidden" name="id" id="id" value="<?= @$res['id'] ?>">
            Name<input type="text" name="name" placeholder="enter username" class="box" value="<?= @$res['name'] ?>"> <?php if (isset($error->empty_name)) echo "<div class='message'> please enter your user name</div>"; ?>
            Email<input type="text" name="email" placeholder="enter email" class="box" value="<?= @$res['email'] ?>"> <?php if (isset($error->empty_email)) echo "<div class='message'> please enter your email</div>"; ?>
            Password<input type="password" name="password" placeholder="enter password" class="box" value="<?= @$res['password'] ?>"> <?php if (isset($error->empty_password)) echo "<div class='message'> please enter your password</div>"; ?>
            Confirm Password <input type="password" name="cpassword" placeholder="confirm password" class="box" value="<?= @$res['password'] ?>"> <?php if (isset($error->empty_cpassword)) echo "<div class='message'> please enter the same password</div>"; ?>
            Room<input type="text" name="room" placeholder="room" class="box" value="<?= @$res['room_id'] ?>"> <?php if (isset($error->empty_room)) echo "<div class='message'> please enter the room</div>"; ?>
            Ext.<input type="text" name="ext" placeholder="ext" class="box" value="<?= @$res['ext'] ?>"> <?php if (isset($error->empty_ext)) echo "<div class='message'> please enter the Ext</div>"; ?>
            <input type="checkbox" name="admin" <?= (@$res['isadmin']) ? 'checked' : '' ?> /> Admin
            <input type="submit" name="submit" value="Save" class="btn btn-primary">
        </form>
    </div>
</body>

</html>