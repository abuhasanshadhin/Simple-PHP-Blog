<?php include "includes/header.php"; ?>

    <section>
        <h1 class="text-center">Author Posts</h1>

        <table class="table-bordered table">
            <tr>
                <th>Serial</th>
                <th>Author Name</th>
                <th>Post Title</th>
                <th>Post Image</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
            <?php
            if (isset($_GET['aid'])) {
                $i = 1;
                foreach ($admin->authorPosts($_GET['aid']) as $authorPost) {
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $authorPost['post_author']; ?></td>
                        <td><?php echo $authorPost['post_title']; ?></td>
                        <td><img src="../<?php echo $authorPost['post_image']; ?>" width="100" height="50"></td>
                        <td><?php echo substr($authorPost['post_description'], 0, 200); ?></td>
                        <td><?php echo $authorPost['post_date']; ?></td>
                    </tr>
                <?php }
            } ?>
        </table>
    </section>

<?php include "includes/footer.php"; ?>