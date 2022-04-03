<?php

include '../controls/database.php';
session_start();

if (!isset($_SESSION['user'])) {
	header('location:../controls/login.php');
}

$date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_NUMBER_INT);
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$user_id = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);
$amount = filter_input(INPUT_GET, 'amount', FILTER_SANITIZE_NUMBER_INT);
$totalamount=0;

/////////////////////////////////

$queryselect = " select products.id ,products.amount from products
 WHERE products.id IN (SELECT orders.product_id FROM orders, useer_order,users WHERE orders.date =:date
 AND orders.order_id=useer_order.order_id 
 AND users.id=useer_order.user_id AND users.id=:id );";
$stmtselect = $db->prepare($queryselect);
$stmtselect->bindValue(":date", $date);
$stmtselect->bindValue(":id", $user_id);
$ress = $stmtselect->execute();

while($row=$stmtselect->fetch(PDO::FETCH_ASSOC)){
$totalamount=$row['amount'] + $amount;
////////////////////////////////////////////////
$queryupdate= "UPDATE products SET amount=:totalamount WHERE products.id= :id";
$stmtupdate = $db->prepare($queryupdate);
$stmtupdate->bindValue(":totalamount", $totalamount);
$stmtupdate->bindValue(":id", $row['id']);
$rbol = $stmtupdate->execute();
}
//////////////////////////
$query = "DELETE b ,v FROM  useer_order b  INNER JOIN orders v on b.order_id=v.order_id and b.user_id=:user_id and v.date=:date";
$stmt = $db->prepare($query);
$stmt->bindValue(":user_id", $user_id);
$stmt->bindValue(":date", $date);
$res=$stmt->execute();

if($stmt->rowCount()){
    
    header('Location:myorder.php');
}
