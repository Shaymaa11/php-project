<?php
require("classcafter.php");
$caftr= new cafter();
$db=$caftr->connect();
$order_name=$_REQUEST["name"];
$order_id=$_REQUEST["prodid"];
$order_img=$_REQUEST["pic"];
$categoryid=$_REQUEST["categoryid"];
$order_price=$_REQUEST["price"];
$userid=$_REQUEST["userid"];

static $amount=1;
//var_dump($categoryid);
$f=1;
$select_prod="select * from products where  id=?";
$stmprod=$db->prepare($select_prod);
$resobj=$stmprod->execute([$order_id]);
$rowprod=$stmprod->fetch(PDO::FETCH_ASSOC);
$rowprods=$rowprod["amount"];
$select_query="select * from apiorder where id_user=? and product_id=? and action=''";
$stm=$db->prepare($select_query);
$resobj=$stm->execute([$userid,$order_id]);
while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
    $amount=(int)$row['amount']+1;
    $rowprodf=(int)$rowprods-$amount;
    $update_query="update apiorder set amount=?,productamount=? where id_user=? and product_id=? ";
    $stmt=$db->prepare($update_query);
    $resobj=$stmt->execute([$amount,$rowprodf,$userid,$order_id]);
$f=0;

}




if($f==1){
   $rowprodss=$rowprods-1;
$ins_query="insert into apiorder(id_user,product_id,category_id,ordername,date,orderprice,orderimag,amount,productamount) 
values (?,?,?,?,?,?,?,?,?);";
   $stmt=$db->prepare($ins_query);
   $id_user=$userid;
   $product_id =$order_id;
   $ordername=$order_name;
   $dt=new DateTime();
  $date=$dt->format('Y-m-d H:i:s');
   $orderprice =$order_price;
   $orderimag=$order_img;
   $res =$stmt->execute([$id_user,$product_id,$categoryid,$ordername,$date,$orderprice,$orderimag, $amount,$rowprodss]);
}


   header("location:index.php");


