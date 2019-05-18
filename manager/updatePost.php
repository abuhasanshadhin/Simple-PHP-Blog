<?php include "includes/header.php"; ?>

    <style>
        label{
            font-weight: bold;
            font-family: "Arial Black"
        }
    </style>

    <section>
        <h1 class="text-center">Update Post</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['updatePost'])){
            $msg = $post->updatePost($_POST, $_FILES);
            echo "<script>alert('$msg'); window.location = 'managePost'</script>";
        }

        if (isset($_GET['peid']) and !empty($_GET['peid'])){
            $post = $post->getPost($_GET['peid']);
        }
        ?>

        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">

                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" value="<?php echo $post['post_title']; ?>" id="post_title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="post_category">Post category</label>
                        <select name="post_category" id="post_category" class="form-control">
                            <option>--Select category--</option>
                            <?php
                            if ($category->getCategories()) {
                                foreach ($category->getCategories() as $category) {
                                    ?>
                                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post_image">Image</label><br>
                        <?php if ($post['post_image'] != null){ ?>
                            <img src="../<?php echo $post['post_image']; ?>" width="200" height="100">
                        <?php }else{echo '--';} ?>
                        <input type="file" name="post_image" id="post_image" class="form-control-file mt-2">
                    </div>

                    <div class="form-group">
                        <label for="post_description">Description</label>
                        <textarea name="post_description" id="post_description" rows='6' cols='80'><?php echo $post['post_description']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="post_status">Publication status</label>
                        <select name="post_status" id="post_status" class="form-control">
                            <option value="0">Publish</option>
                            <option value="1">Unpublish</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="updatePost" value="Update Post" class="btn btn-success">
                    </div>

                </div>
            </div>
        </form>
    </section>

    <script>
        document.getElementById("post_status").value = "<?php echo $post['post_status']; ?>";
        document.getElementById("post_category").value = "<?php echo $post['post_category']; ?>";
    </script>
    
    <script>
		CKEDITOR.replace( 'post_description' );
	</script>

<?php include "includes/footer.php"; ?>