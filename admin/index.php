<?php
session_start();

require_once '../conn.php';
require_once '../function.php';

if(!isset($_SESSION['admin']))
{
    header('location: ../error');
    exit;
}

if(!isset($_SESSION['login']))
{
    $_SESSION['not-login-message'] = "Oops, Anda harus login terlebih daluhu";
    header('location: ../');
    exit;
}

if(isset($_POST['back'])) header('location: ../');
if(isset($_POST['back-1'])) header('location: ./');

$query = mysqli_query($conn, "SELECT * FROM pendaftaran ORDER BY id_pendaftaran DESC");

if(isset($_GET['q']) ? $op = $_GET['q'] : $op = '' );

if($op == 'detail')
{
    $show = $_GET['show'];
    $getDetail = $conn->query("SELECT * FROM pendaftaran WHERE id_pendaftaran = '$show'");

    if(isset($_POST['ubahStatus']))
    {
        $show = $_GET['show'];
        $status = $_POST['status'];

        if($status == "")
        {
            $_SESSION['failed-change-status'] = "Silahkan memilih antara setuju atau proses...";
            header('location: ./index.php?q=detail&show='.$show);
            exit;
        }

        $_SESSION['success-change-status'] = "Status formulir berhasil dirubah menjadi " . $status;
        $query2 = $conn->query("UPDATE pendaftaran SET status = '$status' WHERE id_pendaftaran = '$show'");
        header('location: ./index.php?q=detail&show='.$show);
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

    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <title>Satu Bangsa Harmoni - Detail Pendaftaran</title>
</head>
<body>

    <div class="container my-5">
        <!-- Alert -->
        <?php if(isset($_SESSION['success-change-status'])) { ?>
            <div class="alert alert-success alert-dismissible animate__animated animate__fadeInUp">
                <?= $_SESSION['success-change-status'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } unset($_SESSION['success-change-status']); ?>

        <!-- Alert -->
        <?php if(isset($_SESSION['failed-change-status'])) { ?>
            <div class="alert alert-danger alert-dismissible animate__animated animate__fadeInUp">
                <?= $_SESSION['failed-change-status'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } unset($_SESSION['failed-change-status']); ?>

        <div class="gap-2 d-lg-flex ">
            <div class="col-lg-6 col-12" data-aos="fade-up">
                <img class="ppdb-home-img d-block mx-auto animate__animated animate__fadeInUp animate__fast" src="../assets/img/satubangsa-logo-vertical.png" alt="logo">
            </div>
            <div class="col-lg-6 col-12 mt-5 mt-md-5 mt-lg-0 animate__animated animate__fadeInUp">
                <div class="row-sub-title d-flex align-items-center gap-2">
                    <p class="ppdb-sub-title mb-0">Detail</p><div class="garis"></div>
                </div>
                <p class="ppdb-title fs-2 mb-3 fw-bold">Detail Pendaftaran</p>

                <a href="../export/index.php?q=pdf&export=<?= $show ?>">
                    <button class="cta-ppdb" style="width: 150px; height: 30px">Download Pdf</button>
                </a>

                <form action="" method="post" class="d-flex gap-3 my-2">
                    <div class="input col-8">
                        <select class="form-control" name="status" id="status">
                            <option value="">- Ubah Status -</option>
                            <option value="disetujui"> <i class="bi bi-trash"></i> Disetujui
                            </option>
                            <option value="proses"> Proses
                            </option>
                        </select>
                    </div>
                    <div class="cta col-4">
                        <button class="cta-ppdb" type="submit" name="ubahStatus" style="width: 100px; height: 30px">Simpan</button>
                    </div>
                </form>

                <?php while($rows = mysqli_fetch_assoc($getDetail)): ?>
                    <div class="card">
                        <p class="my-auto text-center" ><small><?= time_elapsed_string($rows['tanggal_pendaftaran']); ?></small></p>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <p class="my-auto fs-5">Akun: <?= ucwords($rows['akun']); ?></p>
                            <?php if($rows['status'] == "disetujui") { ?>
                                <p class="my-auto fs-5">Status: <span class="text-success"><?= ucwords($rows['status']); ?></span></p>
                            <?php } else { ?>
                                <p class="my-auto fs-5">Status: <span class="text-warning"><?= ucwords($rows['status']); ?></span></p>
                            <?php } ?>

                        </div>
                        <div class="card-body">
                            <img class="d-block mx-auto rounded rounded" src="../assets/pas-foto/<?= $rows['pas_foto'] ?>" alt="pasfoto" style="width: 150px; height: 150px;">
                            <table class="table mt-3">
                                <tbody>
                                    <tr>
                                        <th class="col-5">Jurusan</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['jurusan']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nama Peserta Didik</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['nama_peserta_didik']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Jenis Kelamin</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['jenis_kelamin']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nisn</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['nisn']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Alamat</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['alamat_rumah']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Tempat Lahir</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['tempat_lahir']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Tanggal Lahir</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['tanggal_lahir']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Anak ke</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['anak_ke']); ?> dari <?= ucwords($rows['dari_berapa_bersaudara']); ?> bersaudara</td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nomor Hp</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['no_hp']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Email</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['email']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Sekolah Asal</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['sekolah_asal']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Tahun Lulus</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['tahun_lulus']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nomor Kartu Keluarga</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['no_kartu_keluarga']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nama Ayah</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['nama_ayah']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Pekerjaan Ayah</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['pekerjaan_ayah']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Pendidikan Terakhir Ayah</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['pendidikan_terakhir_ayah']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nama Ibu</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['nama_ibu']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Pekerjaan Ibu</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['pekerjaan_ibu']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Pendidikan Terakhir Ibu</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['pendidikan_terakhir_ibu']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nama Wali Murid</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['nama_wali']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Pekerjaan Wali Murid</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['pekerjaan_wali']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Pendidikan Terakhir Wali Murid</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['pendidikan_terakhir_wali']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nomor Hp Ayah</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['no_hp_ayah']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nomor Hp Ibu</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['no_hp_ibu']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Nomor Hp Wali Murid</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['no_hp_wali']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Darimana Tau PPDB</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['darimana_tau_ppdb']); ?></td>
                                    </tr>
                                    <tr>
                                        <th class="col-5">Tanggal Pendaftaran</th>
                                        <td>:</td>
                                        <td><?= ucwords($rows['tanggal_pendaftaran']); ?></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>    
                <?php endwhile; ?>

                <form action="" method="post" class="mt-3">
                    <button type="submit" name="back-1" class="cta-ppdb" style="width:100px; height: 35px;">Kembali</but>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php exit; } ?>

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

    <title>Satu Bangsa Harmoni - Admin</title>
</head>
<body>

    <div class="container mt-5">
        <!-- Alert -->
        <?php if(isset($_SESSION['login-success'])) { ?>
            <div class="alert alert-success alert-dismissible animate__animated animate__fadeInUp animate__slow">
                <?= $_SESSION['login-success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } unset($_SESSION['login-success']);  ?>

        <!-- Alert -->
        <?php if(isset($_SESSION['welcome-admin'])) { ?>
        <div class="alert alert-success alert-dismissible animate__animated animate__fadeInUp animate__slower">
            <?= $_SESSION['welcome-admin'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } unset($_SESSION['welcome-admin']); ?>

        <div class="gap-2 d-lg-flex ">
            <div class="col-lg-6 col-12" data-aos="fade-up">
                <img class="ppdb-home-img d-block mx-auto animate__animated animate__fadeInUp animate__fast" src="../assets/img/satubangsa-logo-vertical.png" alt="logo">
            </div>
            <div class="col-lg-6 col-12 mt-5 mt-md-5 mt-lg-0 animate__animated animate__fadeInUp">
                <div class="row-sub-title d-flex align-items-center gap-2">
                    <p class="ppdb-sub-title mb-0">ADMIN</p><div class="garis"></div>
                </div>
                <p class="ppdb-title fs-3 mb-3 fw-bold">Daftar Formulir Pendaftaran</p>

                <ul class="mt-2 list-group">
                    <?php while($row = mysqli_fetch_assoc($query)): ?>
                    <li class="list-group-item d-flex gap-3">
                        <img class="rounded-circle" src="../assets/pas-foto/<?= $row['pas_foto'] ?>" alt="pasfoto" style="width: 55px; height: 55px;">
                        <div class="action d-flex justify-content-between w-100 align-items-center">
                            <div class="data">
                                <p class="m-0 fw-bold"><?= ucwords($row['akun']); ?></p>
                                <?php if($row['status'] == "disetujui") { ?>
                                    <p class="m-0 text-success"><?= ucwords($row['status']); ?></span></p>
                                <?php } else { ?>
                                    <p class="m-0 text-warning"><?= ucwords($row['status']); ?></span></p>
                                <?php } ?>
                            </div>
                            <div class="action">
                                <a href="?q=detail&show=<?= $row['id_pendaftaran'] ?>" class="btn btn-dark py-0 px-2 d-flex justify-content-center align-items-center">detail</a>
                            </div>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>

                <form action="" method="post" class="mt-3">
                    <button type="submit" name="back" class="cta-ppdb" style="width:100px; height: 35px;">Kembali</but>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</body>
</html>