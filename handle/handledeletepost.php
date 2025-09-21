<?php
require_once '../inc/conn.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
$query="select * from posts where id=$id";
$result=mysqli_query($conn,$query);
if (mysqli_num_rows($result) == 1) {
    $post = mysqli_fetch_assoc($result);
    $old_image=$post['image'];
    if(!empty($old_image)){
        unlink('../assets/images/postimage/'.$old_image);
    }
    $query="delete from posts where id=$id";
    $result=mysqli_query($conn,$query);
    if ($result) {
        $_SESSION['success'] = ['Post deleted successfully "'.$post['title'].'"'];
        header("location:../index.php");
} else {
    $_SESSION['errors'] = ['Error deleting post "'.$post['title'].'"'];
    header("location:../index.php");
}
}else{
    $_SESSION['errors'] = ['Post not found "id='.$id.'"'];
    header("location:../index.php");
}
}else{
    header("location:../index.php");
}
?>