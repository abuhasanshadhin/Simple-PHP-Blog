<?php include "includes/header.php"; ?>

<style>
    label {
        font-weight: bold;
        font-family: "Arial Black"
    }
</style>

<section>
    <h1 class="text-center">Profile</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['update'])){
         $msg = $admin->updateProfile($_POST);
         echo "<script>alert('$msg'); window.location = 'profile'</script>";
    }

    if (isset($_SESSION['id'])){
        $author = $admin->getProfileInfo(Session::get('id'));
    }
    ?>

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form method="post">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $author['name']; ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $author['email']; ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" value="<?php echo $author['type']; ?>" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <input type="hidden" name="author_id" value="<?php echo $author['id']; ?>">
                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-block">
                </div>

            </form>

            <a href="passwordChange"><h6 class="text-danger float-right">
                    <i class="fa fa-long-arrow-right"></i> Change your password</h6>
            </a>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>

