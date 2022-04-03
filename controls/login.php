<?php


include 'database.php';

session_start();

if (isset($_POST['submit'])) {
$message=[];
   $email =  $_POST['email'];
   $password = $_POST['password'];

   $stmt = "SELECT * FROM `users` WHERE `email` =:email AND `password` = :password ";
   $stmt = $db->prepare($stmt);
   $stmt->bindParam(":email", $email);
   $stmt->bindParam(":password", $password);
   $stmt->execute();
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
   if($row){
   switch ($row) {
      case $row["isadmin"] == 1;
         $_SESSION['user'] = $row;
         // var_dump($row);
         // exit;

         header("location:../admin_cafeterai/index.php");
         break;
      case $row["isadmin"] == 0;
               $_SESSION['user'] = $row;
         // var_dump($row);
         // exit;
         header("location:../cafeterai/index.php");
         break;
      default:
      break;
   }
}else{
      $message[] = 'incorrect email or password!';
      header("location:login.php");
   }
   /////////////////////////////////////


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

   <div class="form-container">

      <form action="" method="post">
         <h3>login now</h3>
         <?php
         if (isset($message)) {
            foreach ($message as $message) {
               echo '<div class="message">' . $message . '</div>';
            }
         }
         ?>
         <input type="email" name="email" placeholder="enter email" class="box" required>
         <input type="password" name="password" placeholder="enter password" class="box" required>
         <input type="submit" name="submit" value="login now" class="btn">


      </form>

   </div>

</body>

</html>