<?php
require 'libs/db.php';
require 'libs/format.php';
require 'libs/session.php';
Session::start();

spl_autoload_register(function($class){
    require 'classes/'.$class.'.php';
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
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Friends Zone BD</title>
    <link rel="shortcut icon" href="../img/title_icon.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        header{background-image: url("img/header.jpg"); font-family: "Californian FB";}
        .wrapper{box-shadow: 0px 0px 6px black}
        
        #loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('img/Loading_icon.gif') 50% 50% no-repeat rgb(249,249,249);
            opacity: .8;
        }
    </style>
</head>
<body>
    
<div id="loader"></div>

<script>
    document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'interactive') {
            document.getElementById('container').style.visibility="hidden";
        } else if (state == 'complete') {
            setTimeout(function(){
                document.getElementById('interactive');
                document.getElementById('loader').style.visibility="hidden";
                document.getElementById('container').style.visibility="visible";
            },1000);
        }
    }
</script>
    
<div id="container" class="container wrapper bg-white">

    <header class="card-body mb-2 bg-info row">
        <div class="col-md-11">
            <h3><a href="home"><i class="fa fa-handshake-o"></i> Friends Zone</a></h3>
            <h5 class="text-light ml-5">
                Welcome to our blog
            </h5>
        </div>
        <div class="col-md-1 bg-light">
            <h3 class="mt-2">
                <a href="https://www.facebook.com/friendzonebd.cf" target="_blank"><i class="fa fa-facebook-official"></i></a>
                <a href="https://m.youtube.com/channel/UCX_z0ddOlba-pukrlGAGdIA" target="_blank" class="text-danger"><i class="fa fa-youtube-play"></i></a>
            </h3>
        </div>
    </header>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #e3f2fd;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link active" href="home">Home</a>
                <a class="nav-item nav-link" href="#">About</a>
                <a class="nav-item nav-link" href="#">Contact</a>
            </div>
            <div class="navbar-nav">
                <?php
                if (isset($_GET['a']) and $_GET['a']=='out'){
                    Session::destroy();
                    echo "<script>window.location = 'home'</script>";
                }
                if (Session::get('user_login') == true) {
                ?>
                    <a href="?a=out" class="nav-item nav-link">Logout</a>
                <?php } else { ?>
                    <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#loginModal">Login</a>
                <?php } ?>
                <?php if (Session::get('user_login') == false) { ?>
                <a href="#" class="nav-item nav-link" data-toggle="modal" data-target="#registrationModal">Registration</a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <!--Navbar End-->

    <?php
        if (isset($_POST['login'])){
            $user->userLogin($_POST);
        }

        if (isset($_POST['register'])){
            $user->userRegister($_POST);
        }
    ?>

    <!--Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Login</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!--Registration Modal -->
    <div class="modal fade" id="registrationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Registration</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="user_name" placeholder="Username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="user_email" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="user_password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="retype_password" placeholder="Confirm password" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="register" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


