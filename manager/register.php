<?php include "includes/header.php"; ?>

<?php
if (Session::get('type') != 'admin') {
    echo "<script>window.location = 'dashboard'</script>";
}
?>

<style>
    label {
        font-weight: bold;
        font-family: "Arial Black"
    }
</style>

<section>
    <h1 class="text-center">Register</h1>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['add'])){
            $msg = $admin->register($_POST);
            echo "<script>alert('$msg'); window.location = 'manageAuthor'</script>";
        }
    ?>

    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form method="post">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="editor">Editor</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" name="add" value="Add" class="btn-lg btn btn-success btn-block">
                </div>

            </form>
        </div>
    </div>
</section>

<?php include "includes/footer.php"; ?>
