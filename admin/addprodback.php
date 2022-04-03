<?php
//session_start();
require("classcafter.php");
$caftr= new cafter();
$db=$caftr->connect();
$error=[];
$old=[];
$file_name = $_FILES['file']['name'];
$file_tmp =$_FILES['file']['tmp_name'];
$ext=explode('.',$_FILES['file']['name']);
$file_ext=strtolower(end($ext));
$ext= pathinfo($file_name)["extension"];
$extensions= array("jpeg","jpg","png");
if(in_array($file_ext,$extensions)== false){
$error["pic"]=true;
}
else
{ $old["pic"]=$file_name;
}
if($_REQUEST["pname"] ==""){
    $error["pname"]=true;
   }
   else
   { $old["pname"]=$_REQUEST["pname"];
   }
   if($_REQUEST["price"] ==""){
    $error["price"]=true;
   }
   else
   { $old["price"]=$_REQUEST["price"];
   }
   if($_REQUEST["amount"] ==""){
    $error["amount"]=true;
   }
   else
   { $old["amount"]=$_REQUEST["amount"];
   }
 if(count($error)>0){
	$er=json_encode($error);
	$url="?error={$er}";
	if(count($old)>0){
		$oldval=json_encode($old);
		$url.="&?old={$oldval}";
	}
	header("location:addprodfront.php{$url}");
	
}
 else{
	 
   /******************************/
     $select_query="select * from categories where name=? ";
   $stm=$db->prepare($select_query);
   @$cat=$_REQUEST["selct"];
   $resobj=$stm->execute([$cat]);
   while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
    $catid =$row["id"]; 
   }
 move_uploaded_file($file_tmp, "files/" . $file_name);
 
if($db){
$ins_query="insert into products(name,price,pictur,amount,category_id) values (?,?,?,?,?);";
   $stmt=$db->prepare($ins_query);
   $name=$_REQUEST["pname"];
   $price=$_REQUEST["price"];
   $filename=$file_name;
   $amount=$_REQUEST["amount"];
   
   
  
   @$res =$stmt->execute([$name,$price,$filename,$amount,$catid]);

 //header("log.php");
 }
	header("location:allproduct.php{$url}");

 }
 