<?php
require_once '../inc/conn.php';
//submit,validate,fetch,home

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $errors = [];
    $success=[];
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    if (empty($errors)) {
        $query = "select *from users where email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $id = $user['id'];
            $name = $user['name'];
            $hashed_password = $user['password'];
            $verfiy = password_verify($password, $hashed_password);
            if ($verfiy) {
                $_SESSION['user_id'] = $id;
                header("location:../index.php");
                $success[]= "Login Successfully welcome $name";
                $_SESSION['success'] = $success;
            }else{
                $errors[] = "Email or Password is incorrect";
                header("location:../login.php");
                $_SESSION['errors'] = $errors;
            }
        } else {
            $errors[] = "Email or Password is incorrect";
            header("location:../login.php");
            $_SESSION['errors'] = $errors;
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("location:../login.php");
    }
} else {
    header("location:../login.php");
}
