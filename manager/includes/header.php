<?php
require '../libs/db.php';
require '../libs/format.php';
require '../libs/session.php';
Session::start();

Session::checkLogin('login', false, 'index');

spl_autoload_register(function($class){
    require '../classes/'.$class.'.php';
});

$format = new Format();
$admin = new Admin();
$category = new Category();
$post = new Post();
$user = new User();

$path   = $_SERVER['SCRIPT_FILENAME'];
$c_page = basename($path, '.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard Template for Bootstrap</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="dashboard">Admin-Panel</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($c_page == 'profile' || $c_page == 'passwordChange') echo 'active'; ?>" href="profile">Profile</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="profile">
                        <strong class="text-success">Welcome! </strong><?php echo Session::get('name'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                        if (isset($_GET['out']) and $_GET['out']=='log'){
                            Session::destroy();
                            echo "<script>window.location = 'index'</script>";
                        }
                    ?>
                    <a class="nav-link text-warning font-weight-bold" href="?out=log">
                        <i class="fa fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php if ($c_page == 'manageCategory') echo 'active'; ?>" href="manageCategory">Manage Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($c_page == 'addPost') echo 'active'; ?>" href="addPost">Add Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($c_page == 'managePost' || $c_page == 'updatePost') echo 'active'; ?>" href="managePost">Manage Post</a>
                </li>
            </ul>

            <ul class="nav nav-pills flex-column">
                <?php if (Session::get('type') == 'admin'){ ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($c_page == 'register') echo 'active'; ?>" href="register">Create Admin/Editor</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link <?php if ($c_page == 'manageAuthor') echo 'active'; ?>" href="manageAuthor">Admin/Editors</a>
                </li>
            </ul>

        </nav>

        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">