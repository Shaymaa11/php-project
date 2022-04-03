<?php
//session_start();
$id=(int)$_GET["id"];
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
   
   if($file_name=="" ){
		
    $filename=$_REQUEST["pic"];
      }else{
       
    $filename=$file_name;
    move_uploaded_file($file_tmp, "files/" . $file_name);
          
      }
      
        
        if(count($error)>0){
            $url="?id={$id}";
            $er=json_encode($error);
            $url.="&?error={$er}";
            if(count($old)>0){
                $oldval=json_encode($old);
                $url.="&?old={$oldval}";
            }
            
            header("location:editproduct.php{$url}");
            
        }
         else{
             
           /******************************/
           $select_query="select * from categories where name=? ";
           $stm=$db->prepare($select_query);
           $cat=$_REQUEST["selct"];
           $resobj=$stm->execute([$cat]);
           while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
            $catid =$row["id"]; 
           }
           $caftr->updateproduct($id,$_REQUEST["pname"],$_REQUEST["price"],$filename,$old["amount"],$catid);
          // var_dump("true");
          header("location:allproduct.php");
         }
         