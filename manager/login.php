<?php
include "../libs/db.php";
include "../libs/session.php";
include "../classes/Admin.php";
Session::start();

Session::checkLogin('login', true, 'dashboard');

$admin = new Admin();
?>

<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/css/signin.css">

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['admin_login']))
    {
        $admin->adminLogin($_POST);
    }
?>

<div class="container">
    <form action="" method="post" class="form-signin mt-5">
        <h2 class="form-signin-heading text-center mb-3">Admin/Editor Login</h2>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="admin_email" id="inputEmail" class="form-control" placeholder="Email address">

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="admin_password" id="inputPassword" class="form-control" placeholder="Password">

        <button name="admin_login" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    </form>
</div>
