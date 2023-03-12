<?php
session_start();

require_once '../conn.php';


if(isset($_SESSION['login']))
{
    $_SESSION['already-login-message'] = 'Oops, Anda tidak bisa mengakses halaman itu, karena Anda sudah Login';
    header('location: ../');
}

if(isset($_POST['signup']))
{

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $passwordVerify = htmlspecialchars($_POST['passwordVerify']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);

    $query1 = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $data = mysqli_fetch_assoc($query1);


    if($username && $password && $passwordVerify && $email)
    {
        //? jika username sudah digunakan 
        if(mysqli_num_rows($query1) == 1)
        {
            $_SESSION['username-already-exists'] = "Nama pengguna telah digunakan, silahkan coba yang lain...";
            header('location: ./');
            exit;
        }

        //? jika password verify tidak sama dengan password
        if($passwordVerify != $password) {
            $_SESSION['password-dont-match'] = "Katasandi yang anda masukkan tidak cocok";
            header('location: ./');
            exit;
        }


        $_SESSION['signup-success'] = "Berhasil membuat akun";
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = mysqli_query($conn, "INSERT INTO users(role, username, password, email) VALUES('user','$username','$password','$email')");
        
        //? ambil user_id setelah dibuat akun
        $query2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        $data2 = mysqli_fetch_assoc($query2);

        $_SESSION['login'] = $data2['user_id'];

        if(isset($_SESSION['redirect-ppdb']))
        {
            header('location: ../form-ppdb');
            exit;
        }

        header('location: ../'); exit;

    } else {
        $_SESSION['empty-data'] = "Silahkan melengkapi data pengguna";
        header('location: ./');
        exit;
    }

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

    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <title>Satu Bangsa Harmoni - Signup</title>
</head>
<body>
    <section class="vh-100 mb-5">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">

                    <!-- Alert -->
                    <?php if(isset($_SESSION['username-already-exists'])) { ?>
                        <div class="alert alert-danger alert-dismissible animate__animated animate__fadeInUp">
                            <?= $_SESSION['username-already-exists'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } unset($_SESSION['username-already-exists']); ?>

                    <!-- Alert -->
                    <?php if(isset($_SESSION['password-dont-match'])) { ?>
                        <div class="alert alert-danger alert-dismissible animate__animated animate__fadeInUp">
                            <?= $_SESSION['password-dont-match'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } unset($_SESSION['password-dont-match']); ?>

                    <!-- Alert -->
                    <?php if(isset($_SESSION['empty-data'])) { ?>
                        <div class="alert alert-info alert-dismissible animate__animated animate__fadeInUp">
                            <?= $_SESSION['empty-data'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } unset($_SESSION['empty-data']); ?>

                    
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block img-login-side animate__animated animate__fadeIn animate__slower">
                                <img src="../assets/img/harmoni-gate.jpeg"
                                    alt="Harmoni Gate" class="img-fluid" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center animate__animated animate__fadeInUp">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="" method="POST" id="form-login">

                                    <div class="d-flex align-items-center mb-3 pb-1 img-login-header">
                                        <img src="../assets/img/satubangsa-logo.png" alt="satubangsa logo" class="img-fluid" >
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Buat akun anda</h5>

                                    <div class="form-outline mb-0">
                                        <p class="text-danger mb-0" name="empty-username" id="empty-username"><i class="bi bi-info"></i> nama pengguna wajib diisi</p>
                                        <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="John Wick" autocomplete="off"/>
                                        <label class="form-label" for="username">Nama Pengguna</label>
                                    </div>

                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-password" id="empty-password"><i class="bi bi-info"></i> masukkan katasandi</p>
                                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="***" />
                                        <label class="form-label" for="password">Katasandi</label>
                                    </div>

                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-password-verify" id="empty-password-verify"><i class="bi bi-info"></i> masukkan ulang katasandi</p>
                                        <input type="password" name="passwordVerify" id="passwordVerify" class="form-control form-control-lg" placeholder="ketikkan ulang katasandi anda" />
                                        <label class="form-label" for="password">Verifikasi Katasandi</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                    <p class="text-danger mb-0" name="empty-email" id="empty-email"><i class="bi bi-info"></i> masukkan email</p>
                                        <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="contoh@gmail.com" />
                                        <label class="form-label" for="email">Email</label>
                                    </div>

                                    <div class="pt-1 mb-4 d-flex align-items-center gap-3">
                                        <button class="cta-ppdb" name="signup" id="signup" type="submit" style="width: 100px; height: 30px;">Masuk</button>
                                        <a href="javascript:history.back()">Kembali</a>
                                    </div>

                                    <p class="mb-3 pb-lg-2" style="color: #393f81;">Sudah punya akun? <a href="../login"
                                        style="color: #393f81;">Masuk disini</a></p>
                                    <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small invalid-shake">Privacy policy</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $('#empty-username').css('opacity', '0');
        $('#empty-password').css('opacity', '0');
        $('#empty-password-verify').css('opacity', '0');
        $('#empty-email').css('opacity', '0');
        $('#pesan').css('opacity', '0');
        $('#signup').on('click', function()
        {
            if( $('#username').val().length === 0 ) {
                $('#username').addClass('border-danger');
                $('#empty-username').css('opacity', '1');
                

                $("#username").keypress(function(){
                    $('#username').removeClass('border-danger');
                    $('#empty-username').css('opacity', '0');
                });
            }

            if( $('#password').val().length === 0 ) {
                $('#password').addClass('border-danger');
                $('#empty-password').css('opacity', '1');
                

                $("#password").keypress(function(){
                    $('#password').removeClass('border-danger');
                    $('#empty-password').css('opacity', '0');
                });
            }

            if( $('#passwordVerify').val().length === 0 ) {
                $('#passwordVerify').addClass('border-danger');
                $('#empty-password-verify').css('opacity', '1');
                

                $("#password").keypress(function(){
                    $('#password').removeClass('border-danger');
                    $('#empty-password').css('opacity', '0');
                });
            }

            if( $('#email').val().length === 0 ) {
                $('#email').addClass('border-danger');
                $('#empty-email').css('opacity', '1');
                

                $("#email").keypress(function(){
                    $('#email').removeClass('border-danger');
                    $('#empty-email').css('opacity', '0');
                });
            }

            // var data = $('#form-login').serialize()+'&login=login';
            // $.ajax({
            //     url: '',
            //     type: "POST",
            //     data: data
            // });
        });
    </script>
</body>
</html>