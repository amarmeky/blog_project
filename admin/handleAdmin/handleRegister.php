<?php
require_once '../../inc/conn.php';
//submit,validation,insert
if (isset($_POST['submit'])) {
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $phone = trim(htmlspecialchars($_POST['phone']));
    $psw = trim(htmlspecialchars($_POST['psw']));
    $psw_repeat = trim(htmlspecialchars($_POST['psw-repeat']));
    $errors = [];
    $success = [];
    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (is_numeric($name)) {
        $errors[] = "Name must be a string";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    if (empty($phone)) {
        $errors[] = "Phone is required";
    }
    if (empty($psw)) {
        $errors[] = "Password is required";
    } elseif (strlen($psw) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    if ($psw !== $psw_repeat) {
        $errors[] = "Passwords do not match";
    }
    $checkQuery_email = "select *from users where email='$email'";
    $checkResult_email = mysqli_query($conn, $checkQuery_email);
    if (mysqli_num_rows($checkResult_email) > 0) {
        $errors[] = "Email already exists";
    }
    if (empty($errors)) {
        $passwordhash = password_hash($psw, PASSWORD_DEFAULT);
        $query = "insert into users(name,email,phone,password) values('$name','$email','$phone','$passwordhash')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $success[] = "welcome $name";
            $_SESSION['success'] = $success;
            header('location:../../index.php');
        } else {
            $_SESSION['errors'] = ["Error registering user"];
            header('location:../register.php');
        }
    } else {
        $_SESSION['errors'] = $errors;
        header('location:../register.php');
    }
} else {
    header('location:../register.php');
}
