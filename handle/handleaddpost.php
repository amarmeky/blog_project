<?php
require_once '../inc/conn.php';
if(isset($_POST['submit'])){
    $title=trim(htmlspecialchars($_POST['title']));
    $body=trim(htmlspecialchars($_POST['body']));
    $errors=[];
    $success=[];
    if(empty($title)){
        $errors[]="Title is required";
    }elseif (is_numeric($title)) {
        $errors[]="Title must be a string";
    }
    if(empty($body)){
        $errors[]="Body is required";
    }elseif (is_numeric($body)) {
        $errors[]="Body must be a string";
    }
    if(isset($_FILES['image'])&&$_FILES['image']['name']){
        $image=$_FILES['image'];
        $image_name=$image['name'];
        $tmp_name=$image['tmp_name'];
        $ext=strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $image_errors=$image['error'];
        $size=$image['size']/(1024*1024);
        $new_image=uniqid().".".$ext;
        if ($image_errors!=0) {
            $errors[]="Error uploading image";
        }elseif ($size>1) {
            $errors[]="Image size must be less than 1MB";
        }elseif (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            $errors[]="Invalid image format";
        }
    }else{
        $new_image=null;
    }
    if(empty($errors)){
        $query="INSERT INTO posts (title, body, image,user_id) VALUES ('$title', '$body', '$new_image',1)";
        $result=mysqli_query($conn,$query);
        if ($result) {
            if(isset($new_image)){
                move_uploaded_file($tmp_name, '../assets/images/postimage/'.$new_image);
            }
            $success[]="Post added successfully";
            $_SESSION['success']=$success;
            header('location:../index.php');
        }else{
            $_SESSION['errors']=["Error adding post"];
            header('location:../addpost.php');
        }
    }else{
        $_SESSION['errors']=$errors;
        header('location:../addpost.php');
    }
}else {
    header('location:../addpost.php');
}
