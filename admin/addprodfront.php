<?php

 session_start();
$error=json_decode(@$_GET["error"]);
$old=json_decode(@$_GET["?old"]);
require("classcafter.php");

$caftr= new cafter();
$db=$caftr->connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<title>Title</title>
<style>
.sp{color:red;}
</style>
</head>
<body>
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
    
    <div>
<?php

//  $select_query="select * from users where id=4 ";
//  $stmt=$db->prepare($select_query);
//  $resobj=$stmt->execute();

 
?>


  
  <h3 class="" class="text-muted">Add Product </h3>


    <div class="form-container" class="form-control">

<form action="addprodback.php" method="POST" enctype="multipart/form-data">
<label>Product</label><input type="text" class="box" name="pname" value="<?php if(isset($old->pname)){echo $old->pname ;}?>">
<span class="sp" class="message" ><?php if(isset($error->pname)){echo "Enter Your Product Name";}?> </span><br>
<label>Price</label><input type="number" class="box" name="price" value="<?php if(isset($old->price)){echo $old->price ;}?>">
<span class="sp"  ><?php if(isset($error->price)){echo "Enter  Your Price";}?> </span><br>
<label>Amount</label><input type="number" class="box" name="amount" value="<?php if(isset($old->amount)){echo $old->amount ;}?>">
<span class="sp" ><?php if(isset($error->amount)){echo "Enter Your Amount";}?> </span><br>
<label> Select your Category</label><select name="selct" class="box">
    <?php
 $select_query="select * from categories ";
 $stm=$db->prepare($select_query);
 $resobj=$stm->execute();
 while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
  echo "<option>{$row["name"]}</option> ";
 }
 
    ?>
</select><br>
<!-- <label> <a href="../controls/addcategory.php">Add Category</a><br><hr> -->
<label>Select your picture </label><input type="file" name="file" class="box" />
<span class="sp" ><?php if(isset($error->pic)){echo "Select Your Picture";}?> </span><br>

<input type="submit" class="btn btn-primary" > 
</form>
</div>
</div>
</body>
</html>
