<div class="card-body border">

    <!--Categories-->
    <ul class="list-group">
        <h4 class="list-group-item bg-dark text-light">Categories</h4>
        <?php
        if ($category->getPublishedCategory()) {
            foreach ($category->getPublishedCategory() as $category) {
                ?>
                <li class="list-group-item">
                    <a href="home?cat=<?php echo $category['category_id']; ?>">
                        <?php echo $category['category_name']; ?>
                    </a>
                </li>
            <?php }
        } ?>
    </ul>

    <!--Popular Stories-->
    <ul class="list-group mt-3">
        <h4 class="list-group-item bg-dark text-light">Popular Stories</h4>

        <?php
            $posts = $post->getPopularPost();
            if ($posts){
                foreach ($posts as $post) {
        ?>
        <li class="list-group-item">
            <a href="blog-details?pid=<?php echo $post['id']; ?>"><?php echo $post['post_title']; ?></a>
        </li>
        <?php } } ?>

    </ul>

    <div class="card-body mt-3 border">
        <link href="assets/calendar/dcalendar.picker.css" rel="stylesheet" type="text/css">

        <table id="calendar-demo" class="calendar table-responsive"></table>

        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="assets/calendar/dcalendar.picker.js"></script>
        <script>
            $('#calendar-demo').dcalendar(); //creates the calendar
        </script>
    </div>

</div>