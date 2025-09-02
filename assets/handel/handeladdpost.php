<?php
require_once '../inc/conn.php';
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $body=$_POST['body'];
    if(isset($_FILES['image'])&&$_FILES['image']['name']){
        $image=$_FILES['image'];
        $name=$image['name'];
        $tmp_name=$image['tmp_name'];
        $errors=$image['error'];
        $size=$image['size']/(1024*1024);
    }
}else {
    header('location:../addpost.php');
}
