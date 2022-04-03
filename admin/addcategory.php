<?php
 session_start();
 require("classcafter.php");
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
.p{color:red;}

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
					$myimage = @$_SESSION['user']['image'];
					if (@$myimage == '') {
						echo '<img class="rounded-circle article-img" style="width:80px;" src="../controls/images/default-avatar.png">';
						echo  "<div class='ms-2 d-block' >" . @$_SESSION['user']['name'] . "</div>";
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
    <?php

//  $select_query="select * from categories where id=4 ";
//  $stmt=$db->prepare($select_query);
//  $resobj=$stmt->execute();

 
?>
     <div class="form-container">

       <form action="addbackcat.php" method="POST" enctype="multipart/form-data">

            <h3> add Category </h3> 
            
            <input type="text" name="catname" placeholder="Enter Category " class="box" value="<?php if(isset($old->catname)){echo $old->catname ;}?>"> 
<span class="p" class="message" ><?php if(isset($error->catname)){echo "Enter Your Category Name";}?> </span><br>

 

            <input type="submit" name="submit" value="Save" class="btn btn-primary">

        </form>

    </div>

</body>

</html>