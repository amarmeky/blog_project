<?php
require_once 'inc/conn.php';
require_once 'inc/header.php'; ?>


<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner header-text">
  <div class="owl-banner owl-carousel">
    <div class="banner-item-01">
      <div class="text-content">
        <!-- <h4>Best Offer</h4> -->
        <!-- <h2>New Arrivals On Sale</h2> -->
      </div>
    </div>
    <div class="banner-item-02">
      <div class="text-content">
        <!-- <h4>Flash Deals</h4> -->
        <!-- <h2>Get your best products</h2> -->
      </div>
    </div>
    <div class="banner-item-03">
      <div class="text-content">
        <!-- <h4>Last Minute</h4> -->
        <!-- <h2>Grab last minute deals</h2> -->
      </div>
    </div>
  </div>
</div>
<!-- Banner Ends Here -->

<div class="latest-products">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php
        require_once 'inc/error.php';
        require_once 'inc/success.php';
        ?>
        <div class="section-heading">
          <h2 data-translate="latest-posts">Latest Posts</h2>
          <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
        </div>
      </div>
      <?php
      if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=1");
      }
      $limit = 3;
      $offset = ($page - 1) * $limit;
      $query = "select count(id) as total from posts";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) == 1) {
        $total = mysqli_fetch_assoc($result)['total'];
      }
      $numberOfPages = ceil($total / $limit);
      if ($page > $numberOfPages) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=$numberOfPages");
      }
      if ($page < 1) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=1");
      }

      $query = "select id,title,image,body,created_at from posts order by id limit $limit offset $offset";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
      } else {
        $msg = "not found posts";
        echo "<div class='alert alert-danger w-50 text-center'>$msg</div>";
      }
      ?>
      <?php if (!empty($posts)) {
        foreach ($posts as $post) {
      ?>
          <div class="col-md-4">
            <div class="product-item">
              <a href="viewPost.php?id=<?php echo $post['id']; ?>"><img src="assets/images/postimage/<?php echo $post['image']; ?>" alt="No Image Now" class="product-image"></a>
              <div class="down-content">
                <h4 class="product-title"><?php echo $post['title']; ?></h4>
                <h6 class="product-date"><?php echo $post['created_at']; ?></h6>
                <p class='product-body'> <?php echo $post['body']; ?></p>
                <div class="d-flex justify-content-end">
                  <a href="viewPost.php?id=<?php echo $post['id']; ?>" class="product-button btn btn-info" data-translate="view"> view</a>
                </div>
              </div>
            </div>
          </div>
      <?php  }
      }  ?>
    </div>
  </div>
</div>
<!-- Pagination -->

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center m-2">
    <li class="page-item ">
      <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . ($page - 1); ?>" tabindex="-1" data-translate="previous">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" ><?php echo $page . " of " . $numberOfPages; ?></a></li>
    <li class="page-item ">
      <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . ($page + 1); ?>" data-translate="next">Next</a>
    </li>
  </ul>
</nav>
<?php require_once 'inc/footer.php' ?>