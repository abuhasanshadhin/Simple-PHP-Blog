<?php include "includes/header.php"; ?>

<?php
    if (isset($_POST['verify'])){
        $user->emailVerify($_POST);
    }
?>

<div class="row mt-5 mb-5">
    <div class="col-md-4 offset-md-4 col-sm-6 offset-sm-3">
        <h4 class="text-center font-italic">Email Verification</h4>
        <p class="text-warning font-weight-bold mt-4">We send you a verification code in your email.</p>
        <form method="post" class="">
            <div class="form-group">
                <input type="text" name="verify_code" placeholder="Code" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="verify" value="Verify" class="btn btn-outline-primary btn-block">
            </div>
        </form>
    </div>
</div>

<?php include "includes/footer.php"; ?>