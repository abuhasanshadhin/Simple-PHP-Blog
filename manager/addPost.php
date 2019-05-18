<?php include "includes/header.php"; ?>

    <style>
        label {
            font-weight: bold;
            font-family: "Arial Black"
        }
    </style>

    <section>
        <h1 class="text-center">Add Post</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['addPost'])) {
            $msg = $post->addPost($_POST, $_FILES);
            echo "<script>alert('$msg'); window.location = 'managePost'</script>";
        }
        ?>

        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" id="post_title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="post_category">Post category</label>
                        <select name="post_category" id="post_category" class="form-control">
                            <option value=''>--Select category--</option>
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
                        <label for="post_image">Image</label>
                        <input type="file" name="post_image" id="post_image" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="post_description">Description</label>
                        <textarea name="post_description" id="post_description" rows='6' cols='80'></textarea>
                    </div>

                    <div class="form-group">
                        <label for="post_status">Publication status</label>
                        <select name="post_status" id="post_status" class="form-control">
                            <option value="0">Publish</option>
                            <option value="1">Unpublish</option>
                        </select>
                    </div>

                    <div>
                        <input type="hidden" name="post_author" value="<?php echo Session::get('name')?>">
                        <input type="hidden" name="post_author_id" value="<?php echo Session::get('id')?>">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="addPost" value="Add Post" class="btn btn-primary">
                    </div>

                </div>
            </div>
        </form>
    </section>
    
    <script>
		CKEDITOR.replace( 'post_description' );
	</script>

<?php include "includes/footer.php"; ?>