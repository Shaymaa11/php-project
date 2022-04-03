
<?php
 session_start();
 require("classcafter.php");
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
  
$error=json_decode(@$_GET["error"]);
$old=json_decode(@$_GET["?old"]);
$id=(int)@$_GET["id"];
$caftr= new cafter();
$db=$caftr->connect();
$row=$caftr->selectproduct($id);
//var_dump($id);

?>

  <h3 class="" class="text-muted">Edit Product </h3>


    <div class="form-container" class="form-control">
<form method="Post" action ='<?php echo "updateproduct.php?id={$id}";?>' enctype="multipart/form-data">
    Select your product Name<input name="pname" class="box"   value="<?php if(isset($old->pname)){echo $old->pname ;}else{echo $row[0]['name'];}?>" >
	 Select your price<input name="price" class="box" value="<?php if(isset($old->price)){echo $old->price ;}else{echo $row[0]["price"];}?>">
	 Select your amount<input name="amount" class="box" value="<?php if(isset($old->amount)){echo $old->amount ;}else{echo $row[0]["amount"];}?>">
	<input type="file" class="box" name="file" 	>
	<input name="pic"  value="<?php echo $row[0]["pictur"]; ?>"   >

    
	<label>  Select your Category</label><select class="box" name="selct">
    <?php
 $select_query="select * from categories ";
 $stm=$db->prepare($select_query);
 $resobj=$stm->execute();
 while ($rows = $stm->fetch(PDO::FETCH_ASSOC)){
	 if($rows["id"]==$row[0]["category_id"]){

		echo "<option selected>{$rows["name"]}</option> ";
	 }
	 echo "<option>{$rows["name"]}</option> ";
 }
 
    ?>
</select>
<input type="submit" class="btn btn-primary" > 

    
</form>
</div>
