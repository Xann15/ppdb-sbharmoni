<?php
session_start();

require_once '../conn.php';

if(!isset($_SESSION['login']))
{
    $_SESSION['not-login-message'] = "Oops, Anda harus login terlebih daluhu";
    header('location: ../');
    exit;
}

if(isset($_POST['back']))
{
    header('location: ../');
    exit;
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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- Favicon -->
    <link href="../assets/img/satubangsa-icon.png" rel="icon">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>

    <title>Satu Bangsa Harmoni - PPDB</title>
</head>
<body>

    <div class="container mt-5">
    
        <div class="gap-2 d-lg-flex ">
            <div class="col-lg-6 col-12" data-aos="fade-up">
                <img class="ppdb-home-img d-block mx-auto animate__animated animate__fadeInUp animate__fast" src="../assets/img/satubangsa-logo-vertical.png" alt="logo">
            </div>
            <div class="col-lg-6 col-10 mt-5 mt-md-5 mt-lg-0 animate__animated animate__fadeInUp">
                <div class="row-sub-title d-flex align-items-center gap-2">
                    <p class="ppdb-sub-title mb-0">FORMULIR</p><div class="garis"></div>
                </div>
                <p class="ppdb-title fs-2 mb-3 fw-bold">Status Formulir</p>
                <form action="" method="post">
                    <button type="submit" name="back" class="cta-ppdb" style="width:100px; height: 35px;">Kembali</but>
                </form>
            </div>
        </div>
    </div>
</body>
</html>