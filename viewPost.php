<?php
require_once 'inc/conn.php';
require_once 'inc/header.php';
$id = $_GET['id'];
if (!isset($_GET['id'])) {
  header("location: index.php");
}
$query = "select*from posts where id=$id";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) == 1) {
  $post = mysqli_fetch_assoc($result);
} else {
  $msg = "post not found";
}
?>

<!-- Page Content -->
<div class="page-heading products-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h4>new Post</h4>
          <h2>add new personal post</h2>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="best-features about-features">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php
        require_once 'inc/error.php';
        require_once 'inc/success.php';
        ?>
        <div class="section-heading">
          <h2>Post</h2>
        </div>
      </div>
      <?php
      if (!empty($post)) {
      ?>
        <div class="col-md-6">
          <div class="right-image">
            <img src="assets/images/postimage/<?php echo $post['image']; ?>" alt="No Image Now">
          </div>
        </div>
        <div class="col-md-6">
          <div class="left-content">
            <h4><?php echo $post['title']; ?></h4>
            <p class='post-view'><?php echo $post['body']; ?></p>
            <p><?php echo $post['created_at']; ?></p>

            <div class="d-flex justify-content-center">
              <a href="editPost.php?id=<?php echo $post['id']; ?>" class="btn btn-success mr-3 "> edit post</a>

              <a href="handle/handleDeletePost.php?id=<?php echo $post['id']; ?>"
                onclick="return confirm('Are you sure you want to delete this post?');"
                class="btn btn-danger "> delete post</a>
            </div>
          </div>
        </div>
      <?php
      } else {
        echo "<div class='alert alert-danger w-50'>$msg</div>";
      } ?>
    </div>
  </div>
</div>

<?php require_once 'inc/footer.php' ?>