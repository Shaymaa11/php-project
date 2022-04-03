<?php

include 'database.php';

session_start();

if (!(isset($_SESSION['user']) && $_SESSION['user']['isadmin'])) {
    header('location:login.php');
}

@$error = json_decode($_GET['errors']);

@$old = json_decode($_GET['old']);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin :: Add User</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        p {
            color: red !important;
        }

        .have {
            color: blue !important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">
                <div class="ms-3">
               					<?php
					$myimage = $_SESSION['user']['image'];
					if (@$myimage == '') {
						echo '<img class="rounded-circle article-img" style="width:80px;" src="./images/default-avatar.png">';
						echo  "<div class='ms-2 d-block' >" . $_SESSION['user']['name'] . "</div>";
					} else {
						// echo '<img class="rounded-circle article-img" style="width:80px;" src="./uploaded_image/' . $row['image'] . '">';
						 echo '<img class="rounded-circle article-img" style="width:80px;" src="./uploaded_image/' . $myimage . '">';
						
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
                    <a class="nav-link" href="../admin/addcategory.php">Add Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin_cafeterai/manualOrder.php">Manual Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./allUsers.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/checks.php">Checks</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="form-container">

        <form action="valid.php" method="post" enctype="multipart/form-data">
            <h3> add user </h3><?php
                                if (isset($error->email_exist)) echo "<div class='message'> The email already exist </div>"
                                ?>
            <input type="text" name="name" placeholder="enter username" class="box" value="<?php if (isset($old->name)) {
                                                                                                echo $old->name;
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>"> <?php if (isset($error->empty_name)) echo "<div class='message'> please enter your user name</div>" ?>
            <input type="text" name="email" placeholder="enter email" class="box" value="<?php if (isset($old->vaild_email)) {
                                                                                                echo $old->vaild_email;
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>"> <?php if (isset($error->empty_email)) echo "<div class='message'> please enter your email</div>";
                                                                                                    else if (isset($error->notvaild_email)) echo "<div class='message'> please enter  vaild email</div>"; ?>
            <input type="password" name="password" placeholder="enter password" class="box" value="<?php if (isset($old->password)) {
                                                                                                        echo $old->password;
                                                                                                    } else {
                                                                                                        echo "";
                                                                                                    } ?>"> <?php if (isset($error->empty_password)) echo "<div class='message'> please enter your password</div>" ?>
            <input type="password" name="cpassword" placeholder="confirm password" class="box" value="<?php if (isset($old->cpassword)) {
                                                                                                            echo $old->cpassword;
                                                                                                        } else {
                                                                                                            echo "";
                                                                                                        } ?>"> <?php if (isset($error->empty_cpassword)) echo "<div class='message'> please enter the same password</div>" ?>
            <input type="text" name="room" placeholder="room" class="box" value="<?php if (isset($old->room)) {
                                                                                        echo $old->room;
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?>"> <?php if (isset($error->empty_room)) echo "<div class='message'> please enter the room</div>" ?>
            <input type="text" name="ext" placeholder="ext" class="box" value="<?php if (isset($old->ext)) {
                                                                                    echo $old->ext;
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>"> <?php if (isset($error->empty_ext)) echo "<div class='message'> please enter the Ext</div>" ?>
            <input type="file" name="image" class="box">
            <input type="submit" name="submit" value="Save" class="btn btn-primary">
            <input type="reset" name="reset" value="Reset" class="btn btn-primary">
        </form>

    </div>

</body>

</html>