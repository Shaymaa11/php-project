<?php

include 'database.php';

session_start();

if (!(isset($_SESSION['user']) && $_SESSION['user']['isadmin'])) {
    header('location:login.php');
}

try {

    // $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    $errors = [];

    if (!(isset($_POST['email']) && !empty($_POST['email']))) {
        $errors['empty_email'] = true;
    }

    if (!(isset($_POST['name']) && !empty($_POST['name']))) {
        $errors['empty_name'] = true;
    }

    if (!(isset($_POST['password']) && !empty($_POST['password']))) {
        $errors['empty_password'] = true;
    }

    if (!(isset($_POST['cpassword']) && !empty($_POST['cpassword']) && $_POST['password'] == $_POST['cpassword'])) {
        $errors['empty_cpassword'] = true;
    }

    if (!(isset($_POST['room']) && !empty($_POST['room']))) {
        $errors['empty_room'] = true;
    }

    if (!(isset($_POST['ext']) && !empty($_POST['ext']))) {
        $errors['empty_ext'] = true;
    }

    if (count($errors) > 0) {
        //..
        $error_msg = json_encode($errors);

        // $url = "?id={$id}?errors={$error_msg}";

        $url = "?errors={$error_msg}";

        header("Location:update.php{$url}");
        exit;
    }
    
    if (!empty($_POST)) {

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $admin = (isset($_POST['admin'])) ? 1 : 0;
        $room = $_POST['room'];
        $ext = $_POST['ext'];

        //update
        $query = "UPDATE `users` SET `name`=:name,`email`=:email,`password`=:password,`isadmin`=:admin,`room_id`=:room,`ext`=:ext WHERE `id`=:uid";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":admin", $admin);
        $stmt->bindValue(":room",$room);
        $stmt->bindValue(":ext",$ext);
        $stmt->bindValue(":uid", $id);

        $res = $stmt->execute();

        if ($res) {
            header("location:allUsers.php");
        }
    }
} catch (Exception $e) {

    echo $e->getMessage();
}
