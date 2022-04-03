<?php
class cafter{
    public function connect(){
        $dsn = 'mysql:dbname=cafterai;host=127.0.0.1;port=3306;';
        $user = 'root';
        $password = '';
        $db = new PDO($dsn, $user, $password);
       return $db;
      }
      public function deletproduct($id){
        $connection=cafter::connect();
         $select_query="delete from products where id=?";
         $stmt=$connection->prepare($select_query);
         $id=$id;
         $resobj=$stmt->execute([$id]);
       
       }
 function selectproduct($id){
  $connection=cafter::connect();
  $select_query="select * from products where id=?";
  $stmt=$connection->prepare($select_query);
  $resobj=$stmt->execute([$id]);
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $row;
 }
 function selectallproduct(){
  $connection=cafter::connect();
  $select_query="select * from products ";
  $stmt=$connection->prepare($select_query);
  $resobj=$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $row;
 }
 public function updateproduct($id,...$arg){
  $connection=cafter::connect();
   $update_query="update products set name=?,price=?,pictur=?,amount=?,category_id=?  where id=?";
   $stmt=$connection->prepare($update_query);
   $resobj=$stmt->execute([$arg[0],$arg[1],$arg[2],$arg[3],$arg[4],$id]);

  }
}