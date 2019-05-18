<?php include "includes/header.php"; ?>

<style>
    label {
        font-weight: bold;
        font-family: "Arial Black"
    }
</style>

<section>
    <h1 class="text-center">Change your password</h1>

    <?php
        if (isset($_POST['pass_update'])){
            $msg = $admin->changePassword($_POST);
            echo "<script>alert('$msg'); window.location = 'profile'</script>";
        }
    ?>

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form method="post">
                <div class="form-group">
                    <label for="">Current password</label>
                    <input type="password" name="current_pass" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">New password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Confirm password</label>
                    <input type="password" name="re_password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="pass_update" value="Change" class="btn btn-warning btn-block">
                </div>
            </form>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>
