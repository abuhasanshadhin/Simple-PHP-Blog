<?php include "includes/header.php"; ?>

    <!--Slider-->
    <div id="carouselExampleIndicators" class="carousel slide mt-2" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block img-fluid w-100" src="img/slider1.jpg" alt="First slide"
                     height="300">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid w-100" src="img/slider2.jpeg" alt="Second slide" height="300">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid w-100" src="img/slider1.jpg" alt="Third slide"
                     height="300">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!--Slider End-->

    <!--Main Content-->
    <div class="row mt-2">
        <div class="col-md-8">
            <div class="card-body border">

                <h4 class="card-header mb-4 bg-dark text-light">Latest Stories</h4>

                <?php

                $per_page = 7;
                if (isset($_GET['p'])) {
                    $page = $_GET['p'];
                } else {
                    $page = 1;
                }
                $start_from = ($page - 1) * $per_page;

                if (isset($_GET['cat'])){
                    $posts = $post->getPublishedPostsByCategory($start_from, $per_page, $_GET['cat']);
                }else{
                    $posts = $post->getPublishedPosts($start_from, $per_page);
                }
                
                $post_rows = $posts->num_rows;

                if ($posts) {
                    foreach ($posts as $publishedPost) {
                        ?>
                        <div class="media">
                            <?php if ($publishedPost['post_image'] != null){ ?>
                            <img class="mr-3" src="<?php echo $publishedPost['post_image']; ?>" height="64" width="80"
                                 alt="image">
                            <?php } ?>
                            <div class="media-body">
                                <h5 class="mt-0 font-weight-bold"><?php echo $publishedPost['post_title']; ?></h5>
                                <p>
                                    &#128197; <?php echo $format->dateFormat($publishedPost['post_date']); ?> .
                                    &#128104; <?php echo $publishedPost['post_author']; ?>
                                </p>
                                <p class="text-justify"><?php echo $format->textShorten($publishedPost['post_description'], 300); ?></p>
                                <a href="blog-details?pid=<?php echo $publishedPost['id']; ?>">Read more...</a>
                            </div>
                        </div>
                        <hr>
                    <?php } } ?>

                <?php
                $p_rows = $post->postCountForPagination($per_page);
                if (isset($_GET['p'])) {
                    if($_GET['p'] == $p_rows){
                        $first_page = "Go to first page";
                    }else{
                        $p = $_GET['p'] + 1;
                    }
                } else {
                    $p = 2;
                }
                ?>

                <?php
                if ($post_rows > 0) {
                    if (isset($first_page)) { ?>
                        <p class="text-center">
                            <a href="home.php" class="show-more"><?php echo $first_page; ?></a>
                        </p>
                    <?php }else{ ?>
                        <p class="text-center">
                            <a href="?p=<?php echo $p; ?>" class="show-more">SHOW MORE</a>
                        </p>
                    <?php } } else { ?>
                        <p class="text-center"><a href='home'>Go to Home</a></p>
                    <?php } ?>

            </div>
        </div>
        <div class="col-md-4">
            <?php include "includes/sidebar.php"; ?>
        </div>
    </div>
    <!--Main Content End-->

<?php include "includes/footer.php"; ?>