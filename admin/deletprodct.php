<?php
$id=$_GET["id"];
require("classcafter.php");
$caftr= new cafter();
$caftr->deletproduct($id);
header("location:allproduct.php");

