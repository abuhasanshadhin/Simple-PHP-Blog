<?php include "includes/header.php"; ?>

<section>
    <h1 class="text-center">Blog Members</h1>

    <?php
        if (isset($_GET['adid'])){
            $msg = $admin->removeAuthor($_GET['adid']);
            echo "<script>alert('$msg')</script>";
        }
    ?>

    <table class="table table-bordered text-center">
        <tr>
            <th>Serial</th>
            <th>Name</th>
            <th>Type</th>
            <th>Email</th>
            <th>Added By</th>
            <th>Action</th>
        </tr>
        <?php
        if ($admin->getAuthors()) {
            $i = 1;
            foreach ($admin->getAuthors() as $author) {
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $author['name']; ?></td>
                    <td><?php echo ucwords($author['type']); ?></td>
                    <td><?php echo $author['email']; ?></td>
                    <td><?php echo $author['added_by']; ?></td>
                    <td>
                        <a href="authorPosts?aid=<?php echo $author['id']; ?>">All Post</a>
                        <?php if (Session::get('type') == 'admin') { ?>
                            || <a href="?adid=<?php echo $author['id']; ?>" onclick="return confirm('Are you sure?')">Remove</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php }
        } ?>
    </table>
</section>

<?php include "includes/footer.php"; ?>
