<?php

require("classcafter.php");
$caftr= new cafter();
$db=$caftr->connect();
$error=[];
$old=[];
if($_REQUEST["catname"] ==""){
    $error["catname"]=true;
   }
   else
   { $old["catname"]=$_REQUEST["catname"];
   }
   
 if(count($error)>0){
	$er=json_encode($error);
	$url="?error={$er}";
	if(count($old)>0){
		$oldval=json_encode($old);
		$url.="&?old={$oldval}";
	}
	header("location:addcategory.php{$url}");
}
 else{
if($db){
$ins_query="insert into categories(name) values (?);";
   $stmt=$db->prepare($ins_query);
   $name=$_REQUEST["catname"];
   @$res =$stmt->execute([$name]);
 }
	header("location:../admin_cafeterai/index.php{$url}");

 }
 