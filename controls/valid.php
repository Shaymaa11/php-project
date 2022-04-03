<?php

include 'database.php';

session_start();

if (!(isset($_SESSION['user']) && $_SESSION['user']['isadmin'])) {
    header('location:login.php');
}

try {

    $errors = [];
    $old = [];

    $email = $_POST['email'];
    // var_dump($email);
    $statment = "SELECT email FROM users WHERE `email`=:email";
    $statment = $db->prepare($statment);
    $statment->bindValue(":email", $email);
    $statment->execute();

    // $pattern = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
    // $res = preg_match($pattern, $email);
    $res = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!empty($_POST['email'])) {
        if (!$res) {
            $errors['notvaild_email'] = true;
        } else {
            $old['vaild_email'] = $_POST["email"];
        }
    } else {
        $errors["empty_email"] = $_POST["email"];
    }

    if ($statment->rowCount() > 0) {
        $errors['email_exist'] = true;
    } else {
        $old["email"] = $_POST["email"];
    }

    if (!(isset($_POST['name']) && !empty($_POST['name']))) {
        $errors['empty_name'] = true;
    } else {
        $old["name"] = $_POST["name"];
    }

    if (!(isset($_POST['password']) && !empty($_POST['password']))) {
        $errors['empty_password'] = true;
    } else {
        $old["password"] = $_POST["password"];
    }

    if (!(isset($_POST['cpassword']) && !empty($_POST['cpassword']) && $_POST['password'] == $_POST['cpassword'])) {
        $errors['empty_cpassword'] = true;
    } else {
        $old["cpassword"] = $_POST["cpassword"];
    }

    if (!(isset($_POST['room']) && !empty($_POST['room']))) {
        $errors['empty_room'] = true;
    } else {
        $old["room"] = $_POST["room"];
    }

    if (!(isset($_POST['ext']) && !empty($_POST['ext']))) {
        $errors['empty_ext'] = true;
    } else {
        $old["ext"] = $_POST["ext"];
    }

    if (count($errors) > 0) {
        //..
        $error_msg = json_encode($errors);

        $url = "?errors={$error_msg}";
        if (count($old) > 0) {
            $old_values = json_encode($old);

            $url .= "&old={$old_values}";
        }
        header("Location:addUser.php{$url}");
        exit;
    }
    if (isset($_POST['submit'])) {

        $name =  $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $room = $_POST['room'];
        $ext = $_POST['ext'];
        $image = $_FILES['image'];
        $image_folder = './uploaded_image/';
        $image_file_path = "";

        if ($image) {
            $file = $image;
            $fileType = ($file['type']);
            $fileExtension = substr($fileType, 6);

            if (strpos($fileType, "image") !== false) {
                try {
                    move_uploaded_file($file['tmp_name'], $image_folder . $name . '_avatar.' . $fileExtension);
                    $image_file_path = $name . '_avatar.' . $fileExtension;
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        $stmt = "INSERT INTO `users` (`name`, `email`, `password`, `image`,`room_id`,`ext`) VALUES (:name,:email,:password,:image,:room,:ext)";
        $stmt = $db->prepare($stmt);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":image", $image_file_path);
        $stmt->bindValue(":room", $room);
        $stmt->bindValue(":ext", $ext);
        $stmt->execute();
        // var_dump($stmt->execute());
        header("Location:allUsers.php");
    }
    var_dump($stmt);
} catch (Exception $e) {

    echo $e->getMessage();
}
