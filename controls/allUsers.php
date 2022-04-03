<?php
//connect to mysql
include 'database.php';

session_start();

$_SESSION['user']['isadmin'];
// var_dump($_SESSION['user']['isadmin']);

if (!(isset($_SESSION['user']) && $_SESSION['user']['isadmin'])) {
	header('location:login.php');
}

if (isset($_GET['logout'])) {
	unset($_SESSION['user']);
	session_destroy();
	header('location:login.php');
}


//select all users
$stmt = "SELECT * FROM `users` ";

@$search = $_GET['search'];

if (isset($_GET['search'])) {
	$stmt .= " WHERE `name` LIKE '%" . $search . "%' or `email` LIKE '%" . $search . "%' ";
}
$stmt = $db->prepare($stmt);
$res = $stmt->execute();

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

	<br><br>
	<br>
	<div class="position-relative">
		<div class="position-absolute top-50 start-50 translate-middle m-4">
			<h1 class="">List Users</h1>
			<form method="GET" class="form-container">
				<input type="search" class="form-control m-4" name="search" placeholder="enter the user name or email ">
				<input type="submit" value="search" type="button" class="btn btn-dark position-relative">
			</form>
		</div>
	</div>
	<br><br>
	<div class="container mt-3">
		<tr>
			<h4>
				<td class="ms-auto d-block" style="text-align: center"><?= $count = $stmt->rowCount() . " " ?>Users</a> </td>
			</h4>
			<h4>
				<td style="text-align: center" ><a href="addUser.php">Add User</a></td>
			</h4>
		</tr>
		<table class="table table-dark table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Picture</th>
					<th>Rooms</th>
					<th>Ext.</th>
					<th>Admin</th>
					<th>Actions</th>
				</tr>
			</thead>
			<?php
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { #fetching the record as associative array
			?>
				<tr>
					<td><?= $row["id"] ?></td>
					<td><?= $row["name"] ?></td>
					<td><?= $row["email"] ?></td>
					<td> <?php
							if ($row['image'] == '') {
								echo '<img class="imgtable" src="./images/default-avatar.png">';
							} else {
								// echo row['image'];
								echo '<img class="imgtable" src="./uploaded_image/' . $row['image'] . '">';
							}
							?></td>
					<td><?= $row["room_id"] ?></td>
					<td><?= $row["ext"] ?></td>
					<td><?= ($row["isadmin"]) ? 'Yes' : 'No' ?></td>
					<td><a class="btn btn-primary" href='update.php?id=<?= $row["id"] ?>'>Edit </a>  <a class="btn btn-danger ms-2" href='delete.php?id=<?= $row["id"] ?>'>Delete </a></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>

	</table>
</body>

</html>