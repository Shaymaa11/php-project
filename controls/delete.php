<?php

//delete to db
include 'database.php';
session_start();

if (! (isset($_SESSION['user']) && $_SESSION['user']['isadmin'])) {
	header('location:login.php');
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "DELETE  FROM `users` where id=:uid";

$stmt = $db->prepare($query);
$stmt->bindValue(":uid", $id);
$res=$stmt->execute();

if($stmt->rowCount()){
    
    header('Location:allUsers.php');
}
