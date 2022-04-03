<?php
 session_start();
 require("classcafter.php");
$iduser = $_SESSION['user']['id'];
?>

<html>
    

<head>
	<title> ADMIN :: LIST USERS </title>
	<style>
		body{
			background-color: #f3f4f7 !important; 
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
    <body>
	<div class="position-relative">
			<div class="text-center h1 m-5">
				<h3> All Product</h3>
			</div>                
	</div>
  
 <div>
	   <!-- <div class="container"> -->


<!-- </div> -->
 <?php

 $caftr= new cafter();
 $db=$caftr->connect();
  $select_query="select * from users where id=? ";
  $stmt=$db->prepare($select_query);
  $resobj=$stmt->execute([$iduser]);


  
 ?>
 </div>
 <?php

$select_query="select * from products";
$stmt=$db->prepare($select_query);
$resobj=$stmt->execute();


?>

 	<div class="container mt-3">

		<tr>
			
			<h4>
                    <a class=" text-uppercase text-dark " href="./addprodfront.php">Add Product</a>
               
				<td style="text-align: center" >
			</h4>
		</tr>
		<table class="table table-dark table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Price</th>
					<th>Picture</th>
					<th>Action</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
        
<?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                if($row["amount"]>0){
                    $rowaction="available";
                }
                else{
                    $rowaction="unavilable";
                }

                echo "<tr> <td>{$row["name"]}</td>
                        <td>{$row["price"]}$</td> 
                         <td><img src='./files/{$row["pictur"]}' width=35px height=35px></td>
                        <td>{$rowaction}</td>
                        <td><a href='editproduct.php?id={$row["id"]}' class='btn btn-warning'>Edit </a></td>
                         <td><a href='deletprodct.php?id={$row["id"]}' class='btn btn-danger'>Delete </a></td></tr> 

						";
            }
            echo "</table>";
        ?>
	</table>
	</div>
        </body>
        </html>
                        <!-- <td><a href='deletprodct.php?id={$row["id"]}'>Delete </a></td></tr> -->
