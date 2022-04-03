<?php
//connect to mysql
require("classcafter.php");
$caftr = new cafter();
$db = $caftr->connect();
$select_query = "select users.name ,users.id,SUM(orders.amount) from users,orders,useer_order WHERE
 users.id=useer_order.user_id and orders.order_id=useer_order.order_id GROUP BY users.name;";
$stm = $db->prepare($select_query);
$resobj = $stm->execute();

session_start();

$_SESSION['user'];

if (!(isset($_SESSION['user']))) {
	header('location:../controls/login.php');
}
//id of user
$id = $_SESSION['user']['id'];


?>

<html>

<head>
	<title> My Orders </title>
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
		<table class="table table-dark table-hover">
			<thead>
				<tr>
					<th scope="col-3">Name</th>
					<th scope="col-3">Total Amount</th>
				</tr>
			</thead>
			<?php
			while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
			?>
				<tr>
					<td> <a href='checks.php?add=trure&ids=<?=$row['id']?>'><button class="fa-solid fa-plus bg-dark text-light"  data-bs-toggle="collapse" data-bs-target="#element1"> </button></a> <?= $row["name"]?></td>
					<td><?= $row["SUM(orders.amount)"] ?></td>
				</tr>
			<?php
			}
			?>

			<!-- <a href='checks.php?add=true&ids={$row["id"]}'>
				<input type='button' value='+'></a>
			{$row["name"]}</td>
			<td>{$row["SUM(orders.amount)"]}</td>
			</tr>"; -->
			<tr id="element1" class="collapse">
				<td data-bs-toggle="collapse" data-bs-target="#date1">
					<p id="date1" class="collapse">Order Date:</p>
					<button class="fa-solid fa-plus bg-dark text-light" data-bs-toggle="collapse" data-bs-target="#date1"> </button>
					2202/3/4
					<p id="date1" class="collapse">
						<img src="./images/tea.jpg" width="50px" height="50px">
						<img src="./images/tea.jpg" width="50px" height="50px">
						<img src="./images/tea.jpg" width="50px" height="50px">
						<img src="./images/tea.jpg" width="50px" height="50px">
						<img src="./images/tea.jpg" width="50px" height="50px">

					</p>
				</td>
				<td data-bs-toggle="collapse" data-bs-target="#date1">200
					<p id="date1" class="collapse">Amount</p>
					<p id="date1" class="collapse">3000</p>

				</td>
			</tr>
			<tr id="element1" class="collapse">
				<td data-bs-toggle="collapse" data-bs-target="#date2">
					<p id="date2" class="collapse">Order Date:</p>
					<button class="fa-solid fa-plus bg-dark text-light" data-bs-toggle="collapse" data-bs-target="#date2"> </button>

					2022/2/3
					<p id="date2" class="collapse">
						<img src="./images/tea.jpg" width="50px" height="50px">
						<img src="./images/tea.jpg" width="50px" height="50px">
						<img src="./images/tea.jpg" width="50px" height="50px">
						<img src="./images/tea.jpg" width="50px" height="50px">
						<img src="./images/tea.jpg" width="50px" height="50px">

					</p>
				</td>
				<td data-bs-toggle="collapse" data-bs-target="#date2">300
					<p id="date2" class="collapse">Amount</p>
					<p id="date2" class="collapse">1000</p>

				</td>
			</tr>




		</table>

	</div>

	</table>

	<script src="https://kit.fontawesome.com/4c295a8bce.js" crossorigin="anonymous"></script>
</body>

</html>