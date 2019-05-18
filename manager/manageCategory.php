<?php include "includes/header.php"; ?>

<section>
    <h1 class="text-center">Manage Category</h1>

    <?php
        if (isset($_POST['addCategory'])){
            $msg = $category->addCategory($_POST);
            echo "<script>alert('$msg'); window.location = 'manageCategory'</script>";
        }
    ?>

    <?php
        if (isset($_POST['updateCategory'])){
            $msg = $category->updateCategory($_POST);
            echo "<script>alert('$msg'); window.location = 'manageCategory'</script>";
        }

        if (isset($_GET['ceid']) and !empty($_GET['ceid'])) {
            $category_details = $category->getCategoryDetails($_GET['ceid']);
    ?>

    <form method="post">
        <div class="row">
            <div class="col-md-5 offset-md-3  mt-2">
                <label for="cat-name" class="font-weight-bold font-italic"><h5>Name of category</h5></label>
                <input type="text" name="categoryName" value="<?php echo $category_details['category_name']; ?>" id="cat-name" class="form-control">
                <input type="hidden" name="categoryId" value="<?php echo $category_details['category_id']; ?>">
                <input type="submit" name="updateCategory" value="Update" class="btn btn-success mt-2">
            </div>
        </div>
    </form>
    <?php } else { ?>
    <form method="post">
        <div class="row">
            <div class="col-md-5 offset-md-3  mt-2">
                <label for="cat-name" class="font-weight-bold font-italic"><h5>Name of category</h5></label>
                <input type="text" name="categoryName" id="cat-name" class="form-control">
                <input type="submit" name="addCategory" value="Add" class="btn btn-primary mt-2">
            </div>
        </div>
    </form>
    <?php } ?>

    <table class="table table-bordered text-center mt-4">
        <tr>
            <th>Serial</th>
            <th>Category Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
            if (isset($_GET['cdid']) and !empty($_GET['cdid'])){
                $msg = $category->deleteCategory($_GET['cdid']);
                echo "<script>alert('$msg'); window.location = 'manageCategory'</script>";
            }

            if (isset($_GET['cuid']) and !empty($_GET['cuid'])){
                $msg = $category->unpublishCategory($_GET['cuid']);
                echo "<script>alert('$msg'); window.location = 'manageCategory'</script>";
            }

            if (isset($_GET['cpid']) and !empty($_GET['cpid'])){
                $msg = $category->publishCategory($_GET['cpid']);
                echo "<script>alert('$msg'); window.location = 'manageCategory'</script>";
            }
        ?>

        <?php
            if ($category->getCategories()){
                $i = 1;
                foreach ($category->getCategories() as $category) {
        ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $category['category_name']; ?></td>
                <td>
                    <?php
                        if ($category['category_status'] == 0){
                            echo "<span class='text-success'>Publish</span>";
                        } else{
                            echo "<span class='text-warning'>Unpublish</span>";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        if ($category['category_status'] == 0){
                            echo "<a href='?cuid={$category['category_id']}'>Unpublish</a> || ";
                        } else{
                            echo "<a href='?cpid={$category['category_id']}'>Publish</a> || ";
                        }
                    ?>
                    <a href="?ceid=<?php echo $category['category_id']; ?>">Edit</a> ||
                    <a href="?cdid=<?php echo $category['category_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php } } ?>
    </table>
</section>

<?php include "includes/footer.php"; ?>
