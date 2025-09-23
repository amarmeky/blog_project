<?php 
require_once 'inc/conn.php';
require_once 'inc/header.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!-- Page Content -->
<div class="page-heading products-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h4 data-translate="new-post">new Post</h4>
          <h2 data-translate="add-new-personal-post">add new personal post</h2>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container w-50 ">
  <?php
  require_once 'inc/error.php';
  ?>
  <div class="d-flex justify-content-center">
    <h3 class="my-5" data-translate="add-new-post">add new Post</h3>
  </div>
  <form method="POST" action="handle/handleaddpost.php" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title" class="form-label" data-translate="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="">
    </div>
    <div class="mb-3">
      <label for="body" class="form-label" data-translate="body">Body</label>
      <textarea class="form-control" id="body" name="body" rows="5"></textarea>
    </div>
    <div class="mb-3">
      <label for="body" class="form-label" data-translate="image">image</label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <!-- <img src="uploads/<?php echo $post['image'] ?>" alt="" width="100px" srcset=""> -->
    <button type="submit" class="btn btn-primary" name="submit" data-translate="add-post">add post</button>
  </form>
</div>

<?php require_once 'inc/footer.php' ?>