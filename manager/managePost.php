<?php include "includes/header.php"; ?>

    <section class="text-center">
        <h1 class="text-center">Manage Post</h1>

        <?php
            if (isset($_GET['pdid']) and !empty($_GET['pdid'])){
                $msg = $post->deletePost($_GET['pdid']);
                echo "<script>alert('$msg'); window.location = 'managePost'</script>";
            }

            if (isset($_GET['puid']) and !empty($_GET['puid'])){
                $msg = $post->unpublishPost($_GET['puid']);
                echo "<script>alert('$msg'); window.location = 'managePost'</script>";
            }

            if (isset($_GET['ppid']) and !empty($_GET['ppid'])){
                $msg = $post->publishPost($_GET['ppid']);
                echo "<script>alert('$msg'); window.location = 'managePost'</script>";
            }
        ?>

        <table class="table table-bordered text-center mt-4">
            <tr>
                <th>Serial</th>
                <th>Title</th>
                <th>Category</th>
                <th>Image</th>
                <th>Description</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php
                if ($post->getPosts()){
                    $i = 1;
                    foreach ($post->getPosts() as $post) {
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $post['post_title']; ?></td>
                    <td><?php echo $post['category_name']; ?></td>
                    <td>
                        <?php if ($post['post_image'] != null){ ?>
                            <img src="../<?php echo $post['post_image']; ?>" width="80" height="60">
                        <?php }else{echo '--';} ?>
                    </td>
                    <td class="text-justify"><?php echo substr($post['post_description'], 0, 200); ?></td>
                    <td>
                        <?php
                            if ($post['post_status'] == 0){
                                echo 'Publish';
                            }else{
                                echo 'Unpublish';
                            }
                        ?>
                    </td>
                    <td><?php echo $post['post_date']; ?></td>
                    <td>
                        <?php
                        if ($post['post_status'] == 0){
                            echo "<a href='?puid={$post['id']}'>Unpublish</a> || ";
                        } else{
                            echo "<a href='?ppid={$post['id']}'>Publish</a> || ";
                        }
                        ?>
                        <a href="updatePost?peid=<?php echo $post['id']; ?>">Edit</a> ||
                        <a href="?pdid=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } } ?>
        </table>
    </section>

<?php include "includes/footer.php"; ?>