<?php
session_start();

if(isset($_POST['destroy-session']))
{
    session_destroy();
    header('refresh:0;url=');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link href="assets/img/satubangsa-icon.png" rel="icon">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

    <title>Satu Bangsa Harmoni</title>
</head>
<body>
    <div class="container mt-5">

    <!-- Alert -->
    <?php if(isset($_SESSION['signup-success'])) { ?>
        <div class="alert alert-success alert-dismissible animate__animated animate__fadeInUp">
            <?= $_SESSION['signup-success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } unset($_SESSION['signup-success']); ?>


    <!-- Alert -->
    <?php if(isset($_SESSION['login-success'])) { ?>
        <div class="alert alert-success alert-dismissible animate__animated animate__fadeInUp">
            <?= $_SESSION['login-success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } unset($_SESSION['login-success']); ?>


    <!-- Alert -->
    <?php if(isset($_SESSION['already-login-message'])) { ?>
        <div class="alert alert-danger alert-dismissible animate__animated animate__fadeInUp">
            <?= $_SESSION['already-login-message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } unset($_SESSION['already-login-message']); ?>

    <!-- Alert -->
    <?php if(isset($_SESSION['not-login-message'])) { ?>
        <div class="alert alert-danger alert-dismissible animate__animated animate__fadeInUp">
            <?= $_SESSION['not-login-message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } unset($_SESSION['not-login-message']); ?>

    <!-- Alert -->
    <?php if(isset($_SESSION['admin-try-message'])) { ?>
        <div class="alert alert-info alert-dismissible animate__animated animate__fadeInUp">
            <?= $_SESSION['admin-try-message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } unset($_SESSION['admin-try-message']); ?>

        <!-- Destroy SESSION -->
        <form action="" method="post">
            <button type="submit" class="cta-ppdb" name="destroy-session"><i class="bi bi-trash"></i></button>
        </form>

        <a href="ppdb/" class="btn btn-danger mt-4">PPDB</a>
        <a href="login/" class="btn btn-danger mt-4">Login</a>
        <a href="status-ppdb/" class="btn btn-danger mt-4">Cek Status</a>
        <?php if(isset($_SESSION['admin'])) { ?>
            <a href="admin/" class="btn btn-danger mt-4">Admin</a>
        <?php } ?>
    </div>
</body>
</html>