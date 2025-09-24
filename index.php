<?php
require_once 'inc/conn.php';
require_once 'inc/header.php'; ?>


<!-- Page Content -->
<!-- Banner Starts Here -->

<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="5000">
      <img src="assets/images/products-heading.jpg" class="d-block w-100" alt="slide 1">
    </div>

    <div class="carousel-item" data-bs-interval="5000">
      <img src="assets/images/services-bg.jpg" class="d-block w-100" alt="slide 2">
    </div>

    <div class="carousel-item" data-bs-interval="5000">
      <img src="assets/images/slide_01.jpg" class="d-block w-100" alt="slide 3">
    </div>
  </div>

  <!-- أزرار السابق/التالي -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">السابق</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">التالي</span>
  </button>
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
    <?php if ($page > 1) { ?>
      <li class="page-item">
        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . ($page - 1); ?>" data-translate="previous">Previous</a>
      </li>
    <?php } else { ?>
      <li class="page-item disabled">
        <span class="page-link" tabindex="-1" aria-disabled="true" data-translate="previous">Previous</span>
      </li>
    <?php } ?>

    <li class="page-item">
      <a class="page-link"><?php echo $page . " of " . $numberOfPages; ?></a>
    </li>

    <?php if ($page < $numberOfPages) { ?>
      <li class="page-item">
        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] . "?page=" . ($page + 1); ?>" data-translate="next">Next</a>
      </li>
    <?php } else { ?>
      <li class="page-item disabled">
        <span class="page-link" tabindex="-1" aria-disabled="true" data-translate="next">Next</span>
      </li>
    <?php } ?>
  </ul>
</nav>

<?php require_once 'inc/footer.php' ?>