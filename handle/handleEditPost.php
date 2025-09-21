<?php
require_once '../inc/conn.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
if (isset($_POST['submit']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $title = trim(htmlspecialchars($_POST['title']));
    $body = trim(htmlspecialchars($_POST['body']));
    $errors = [];
    $success = [];
    if (empty($title)) {
        $errors[] = "Title is required";
    } elseif (is_numeric($title)) {
        $errors[] = "Title must be a string";
    } elseif (strlen($title) < 4) {
        $errors[] = "Title must be at least 4 characters";
    }
    if (empty($body)) {
        $errors[] = "Body is required";
    } elseif (is_numeric($body)) {
        $errors[] = "Body must be a string";
    }
    $query = "select * from posts where id=$id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $old_image = mysqli_fetch_assoc($result)['image'];
        if (isset($_FILES['image']) && $_FILES['image']['name']) {
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $tmp_name = $image['tmp_name'];
            $error_image = $image['error'];
            $size = $image['size'] / (1024 * 1024);
            $new_image = uniqid() . "." . $ext;
            if ($error_image != 0) {
                $errors[] = "Error uploading image";
            } elseif ($size > 1) {
                $errors[] = "Image size must be less than 1MB";
            } elseif (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $errors[] = "Image format must be jpg, jpeg, png or gif  ";
            }
        } else {
            $new_image = $old_image;
        }
        if (empty($errors)) {
            $query = "update posts set `title`='$title',`body`='$body',`image`='$new_image' where id=$id";
            $result = mysqli_query($conn, $query);
            if ($result) {
                move_uploaded_file($tmp_name, '../assets/images/postimage/'.$new_image);

                $success[] = "Post updated successfully";
                $_SESSION['success'] = $success;
                header("location:../viewpost.php?id=$id");
            } else {
                $_SESSION['errors'] = ['Failed to update post'];
            }
        } else {
            $_SESSION['errors'] = $errors;
            header("location:../editpost.php?id=$id");
        }
    } else {
        $_SESSION['errors'] = ["Post not found"];
        header("location:../index.php");
    }
} else {
    header("location:../index.php");
}
