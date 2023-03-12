<?php
session_start();

require_once '../conn.php';


if(!isset($_SESSION['login']))
{
    $_SESSION['not-login-message'] = "Oops, Anda harus login terlebih daluhu";
    header('location: ../');
    exit;
}

if(isset($_SESSION['admin']))
{
    $_SESSION['admin-try-message'] = "Oops, hanya pengguna biasa yang bisa mengisi formulir pendaftaran";
    header('location: ../');
    exit;
}

if(isset($_POST['kirim-formulir']))
{

    $user_id = $_SESSION['login'];

    $q = mysqli_query($conn, "SELECT username FROM users WHERE user_id = '$user_id'");
    $a = mysqli_fetch_assoc($q);
    $akun = $a['username'];
    $status = "proses";
    $jurusan = htmlspecialchars($_POST['jurusan']);
    $calonSiswa = htmlspecialchars($_POST['nama-peserta-didik']);
    $jenisKelamin = htmlspecialchars($_POST['gender']);
    $nisn = htmlspecialchars($_POST['nisn']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tempatLahir = htmlspecialchars($_POST['tempat-lahir']);
    $tanggalLahir = htmlspecialchars($_POST['tanggal-lahir']);
    $anakKe = htmlspecialchars($_POST['anak-ke']);
    $berapaBersaudara = htmlspecialchars($_POST['berapa-bersaudara']);
    $nohp = htmlspecialchars($_POST['nohp']);
    $email = htmlspecialchars($_POST['email']);
    $sekolahAsal = htmlspecialchars($_POST['sekolah-asal']);
    $tahunLulus = htmlspecialchars($_POST['tahun-lulus']);

    $noKk = htmlspecialchars($_POST['nokk']);
    $namaAyah = htmlspecialchars($_POST['nama-ayah']);
    $pekerjaanAyah = htmlspecialchars($_POST['pekerjaan-ayah']);
    $pendidikanAyah = htmlspecialchars($_POST['pendidikan-terakhir-ayah']);
    $namaIbu = htmlspecialchars($_POST['nama-ibu']);
    $pekerjaanIbu = htmlspecialchars($_POST['pekerjaan-ibu']);
    $pendidikanIbu = htmlspecialchars($_POST['pendidikan-terakhir-ibu']);
    $namaWali = htmlspecialchars($_POST['nama-wali']);
    $pekerjaanWali = htmlspecialchars($_POST['pekerjaan-wali']);
    $pendidikanWali = htmlspecialchars($_POST['pendidikan-terakhir-wali']);
    $nohpAyah = htmlspecialchars($_POST['nohp-ayah']);
    $nohpIbu = htmlspecialchars($_POST['nohp-ibu']);
    $nohpWali = htmlspecialchars($_POST['nohp-wali']);
    $invitedBy = htmlspecialchars($_POST['darimana-tau']);

    $imageName = $_FILES['pas-foto']['name'];
    $imageSize = $_FILES['pas-foto']['size'];
    $imageError = $_FILES['pas-foto']['error'];
    $imageType = $_FILES['pas-foto']['type'];
    $dir = "../assets/pas-foto/";
    

    // //?Logic extention
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', '.webp'];
    $ekstensiGambar = explode('.', $imageName);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        $_SESSION['invalid-pasfoto'] = "Format gambar tidak didukung";
        header('refresh:0;url=');
        exit;
    }

    $tanggalPendaftaran = date('Y-m-d H:i:s');

    if($jurusan && $calonSiswa && $jenisKelamin && $nisn && $alamat && $tempatLahir && $tanggalLahir && $anakKe && $berapaBersaudara && $nohp && $email && $sekolahAsal && $tahunLulus && $noKk && $namaAyah && $pekerjaanAyah && $pendidikanAyah && $namaIbu && $pekerjaanIbu && $pendidikanIbu && $namaWali && $pekerjaanWali && $pendidikanWali && $nohpAyah && $nohpIbu && $nohpWali && $invitedBy)
    {
        move_uploaded_file($_FILES['pas-foto']['tmp_name'], $dir.$imageName);
        mysqli_query($conn, 
        "INSERT INTO pendaftaran(user_id, akun, status, jurusan, nama_peserta_didik, jenis_kelamin, nisn, alamat_rumah, tempat_lahir, tanggal_lahir, anak_ke, dari_berapa_bersaudara, no_hp, email, sekolah_asal, tahun_lulus, tanggal_pendaftaran, pas_foto, no_kartu_keluarga, nama_ayah, pekerjaan_ayah, pendidikan_terakhir_ayah, nama_ibu, pekerjaan_ibu, pendidikan_terakhir_ibu, nama_wali, pekerjaan_wali, pendidikan_terakhir_wali, no_hp_ayah, no_hp_ibu, no_hp_wali, darimana_tau_ppdb) 
        VALUES('$user_id', '$akun', '$status', '$jurusan', '$calonSiswa', '$jenisKelamin', '$nisn', '$alamat', '$tempatLahir', '$tanggalLahir', '$anakKe', '$berapaBersaudara', '$nohp', '$email', '$sekolahAsal', '$tahunLulus', '$tanggalPendaftaran',  '$imageName', '$noKk', '$namaAyah', '$pekerjaanAyah', '$pendidikanAyah', '$namaIbu', '$pekerjaanIbu', '$pendidikanIbu', '$namaWali', '$pekerjaanWali', '$pendidikanWali', '$nohpAyah', '$nohpIbu', '$nohpWali', '$invitedBy')");

        $_SESSION['formulir-terkirim'] = "Formulir berhasil terkirim";
        header('refresh:0; url=');
        exit;
    } else {
        $_SESSION['input-tidak-lengkap'] = "Mohon pastikan semua data telah terisi...";
        header('refresh:0; url=');
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

    <title>Satu Bangsa Harmoni - Formulir PPDB</title>
</head>
<body>
    <section class="vh-100 mb-5">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10 p-0">

                    <!-- Alert -->
                    <?php if(isset($_SESSION['login-success'])) { ?>
                        <div class="alert alert-success alert-dismissible animate__animated animate__fadeInUp">
                            <?= $_SESSION['login-success'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } unset($_SESSION['login-success']); ?>

                    <!-- Alert -->
                    <?php if(isset($_SESSION['signup-success'])) { ?>
                        <div class="alert alert-success alert-dismissible animate__animated animate__fadeInUp">
                            <?= $_SESSION['signup-success'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } unset($_SESSION['signup-success']); ?>

                    <!-- Alert -->
                    <?php if(isset($_SESSION['formulir-terkirim'])) { ?>
                        <div class="alert alert-success alert-dismissible animate__animated animate__fadeInUp">
                            <?= $_SESSION['formulir-terkirim'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } unset($_SESSION['formulir-terkirim']); ?>

                    <!-- Alert -->
                    <?php if(isset($_SESSION['input-tidak-lengkap'])) { ?>
                        <div class="alert alert-danger alert-dismissible animate__animated animate__fadeInUp">
                            <?= $_SESSION['input-tidak-lengkap'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } unset($_SESSION['input-tidak-lengkap']); ?>

                    <!-- Alert -->
                    <?php if(isset($_SESSION['invalid-pasfoto'])) { ?>
                        <div class="alert alert-danger alert-dismissible animate__animated animate__fadeInUp">
                            <?= $_SESSION['invalid-pasfoto'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } unset($_SESSION['invalid-pasfoto']); ?>

                    
                    <div class="card" style="border: none">
                        <div class="row g-0">
                            <div class="col-12 d-flex align-items-center animate__animated animate__fadeInUp">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="" method="POST" id="form-login" enctype="multipart/form-data">

                                    <div class="d-flex align-items-center mb-3 pb-1 img-login-header">
                                        <img src="../assets/img/satubangsa-logo.png" alt="satubangsa logo" class="img-fluid" >
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Isi formulir</h5>

                                    <!-- Jurusan -->
                                    <div class="form-outline mb-0">
                                        <p class="text-danger mb-0" name="empty-jurusan" id="empty-jurusan"><i class="bi bi-info"></i> pilih jurusan</p>
                                        <select class="form-control" name="jurusan" id="jurusan">
                                            <option value="">- Pilih Jurusan -</option>
                                            <option value="rekayasa prangkat lunak"> Rekayasa Prangkat Lunak
                                            </option>
                                            <option value="akutansi"> Akuntansi
                                            </option>
                                        </select>
                                        <label class="form-label" for="jurusan">Jurusan</label>
                                    </div>

                                    <!-- Nama peserta didik -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nama-peserta-didik" id="empty-nama-peserta-didik"><i class="bi bi-info"></i> masukkan katasandi</p>
                                        <input type="text" name="nama-peserta-didik" id="nama-peserta-didik" class="form-control" />
                                        <label class="form-label" for="nama-peserta-didik">Nama peserta didik</label>
                                    </div>

                                    <!-- Jenis kelamin -->
                                    <div class="form-outline mb-0">
                                        <p class="text-danger mb-0" name="empty-gender" id="empty-gender"><i class="bi bi-info"></i> pilih jenis kelamin</p>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="">- Jenis Kelamin -</option>
                                            <option value="laki laki"> Pria
                                            </option>
                                            <option value="perempuan"> Wanita
                                            </option>
                                        </select>
                                        <label class="form-label" for="gender">Jenis Kelamin</label>
                                    </div>

                                    <!-- NISN -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nisn" id="empty-nisn"><i class="bi bi-info"></i> masukkan nisn</p>
                                        <input type="number" name="nisn" id="nisn" class="form-control" />
                                        <label class="form-label" for="nisn">Nisn</label>
                                    </div>

                                    <!-- Alamat Rumah -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-alamat" id="empty-alamat"><i class="bi bi-info"></i> masukkan alamat</p>
                                        <input type="text" name="alamat" id="alamat" class="form-control" />
                                        <label class="form-label" for="alamat">Alamat</label>
                                    </div>

                                    <!-- Tempat Lahir -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-tempat-lahir" id="empty-tempat-lahir"><i class="bi bi-info"></i> masukkan tempat lahir</p>
                                        <input type="text" name="tempat-lahir" id="tempat-lahir" class="form-control" />
                                        <label class="form-label" for="tempat-lahir">Tempat Lahir</label>
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-tanggal-lahir" id="empty-tanggal-lahir"><i class="bi bi-info"></i> masukkan tanggal lahir</p>
                                        <input type="date" name="tanggal-lahir" id="tanggal-lahir" class="form-control" />
                                        <label class="form-label" for="tanggal-lahir">Tanggal Lahir</label>
                                    </div>

                                    <!-- Anak ke -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-saudara" id="empty-saudara"><i class="bi bi-info"></i> tidakboleh kosong</p>
                                        <input type="number" name="anak-ke" id="anak-ke" class="form-control" placeholder="Anak ke" />
                                        <input type="number" name="berapa-bersaudara" id="berapa-bersaudara" class="form-control" placeholder="Dari berapa bersaudara" />
                                        <label class="form-label" for="anak-ke">Anak ke</label>
                                    </div>

                                    <!-- No hp / wa -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nohp" id="empty-nohp"><i class="bi bi-info"></i> masukkan no hp / wa</p>
                                        <input type="tel" name="nohp" id="nohp" class="form-control" />
                                        <label class="form-label" for="nohp">No hp / wa</label>
                                    </div>
                                    
                                    <!-- Email -->
                                    <div class="form-outline mb-4">
                                    <p class="text-danger mb-0" name="empty-email" id="empty-email"><i class="bi bi-info"></i> masukkan email</p>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="contoh@gmail.com" />
                                        <label class="form-label" for="email">Alamat Email Aktif</label>
                                    </div>

                                    <!-- Sekolah Asal -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-sekolah-asal" id="empty-sekolah-asal"><i class="bi bi-info"></i> masukkan sekolah asal</p>
                                        <input type="text" name="sekolah-asal" id="sekolah-asal" class="form-control" />
                                        <label class="form-label" for="sekolah-asal">Sekolah Asal</label>
                                    </div>

                                    <!-- Tahun Lulus -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-tahun-lulus" id="empty-tahun-lulus"><i class="bi bi-info"></i> masukkan tahun lulus</p>
                                        <input type="month" name="tahun-lulus" id="tahun-lulus" class="form-control" />
                                        <label class="form-label" for="tahun-lulus">Tahun Lulus</label>
                                    </div>

                                    <!-- Pas Foto -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-pas-foto" id="empty-pas-foto"><i class="bi bi-info"></i> Upload pas foto</p>
                                        <img class="mb-2" id="preview-pasfoto" width="50" src="" alt="pas foto">
                                        <input type="file" onchange="readURL(this);" name="pas-foto" id="pas-foto" class="form-control" />
                                        <label class="form-label" for="pas-foto">Pas Foto</label>
                                    </div>

                                    <!-- No Kartu Keluarga -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nokk" id="empty-nokk"><i class="bi bi-info"></i> masukkan no kk</p>
                                        <input type="number" name="nokk" id="nokk" class="form-control" />
                                        <label class="form-label" for="nokk">No Kartu Keluarga</label>
                                    </div>

                                    <!-- Nama Ayah -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nama-ayah" id="empty-nama-ayah"><i class="bi bi-info"></i> masukkan nama ayah</p>
                                        <input type="text" name="nama-ayah" id="nama-ayah" class="form-control" />
                                        <label class="form-label" for="nama-ayah">Nama Ayah</label>
                                    </div>

                                    <!-- Pekerjaan Ayah -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-pekerjaan-ayah" id="empty-pekerjaan-ayah"><i class="bi bi-info"></i> masukkan pekerjaan ayah</p>
                                        <input type="text" name="pekerjaan-ayah" id="pekerjaan-ayah" class="form-control" />
                                        <label class="form-label" for="pekerjaan-ayah">Pekerjaan Ayah</label>
                                    </div>

                                    <!-- Pendidikan Terakhir Ayah -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-pendidikan-terakhir-ayah" id="empty-pendidikan-terakhir-ayah"><i class="bi bi-info"></i> masukkan pendidikan terakhir ayah</p>
                                        <input type="text" name="pendidikan-terakhir-ayah" id="pendidikan-terakhir-ayah" class="form-control" />
                                        <label class="form-label" for="pendidikan-terakhir-ayah">Pendidikan Terakhir Ayah</label>
                                    </div>

                                    <!-- Nama Ibu -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nama-ibu" id="empty-nama-ibu"><i class="bi bi-info"></i> masukkan nama ibu</p>
                                        <input type="text" name="nama-ibu" id="nama-ibu" class="form-control" />
                                        <label class="form-label" for="nama-ibu">Nama Ibu</label>
                                    </div>

                                    <!-- Pekerjaan Ibu -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-pekerjaan-ibu" id="empty-pekerjaan-ibu"><i class="bi bi-info"></i> masukkan pekerjaan ibu</p>
                                        <input type="text" name="pekerjaan-ibu" id="pekerjaan-ibu" class="form-control" />
                                        <label class="form-label" for="pekerjaan-ibu">Pekerjaan Ibu</label>
                                    </div>

                                    <!-- Pendidikan Terakhir Ibu -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-pendidikan-terakhir-ibu" id="empty-pendidikan-terakhir-ibu"><i class="bi bi-info"></i> masukkan pendidikan terakhir ibu</p>
                                        <input type="text" name="pendidikan-terakhir-ibu" id="pendidikan-terakhir-ibu" class="form-control" />
                                        <label class="form-label" for="pendidikan-terakhir-ibu">Pendidikan Terakhir Ibu</label>
                                    </div>

                                    <!-- Nama Wali -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nama-wali" id="empty-nama-wali"><i class="bi bi-info"></i> masukkan nama wali</p>
                                        <input type="text" name="nama-wali" id="nama-wali" class="form-control" />
                                        <label class="form-label" for="nama-wali">Nama Wali Murid</label>
                                    </div>

                                    <!-- Pekerjaan Wali -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-pekerjaan-wali" id="empty-pekerjaan-wali"><i class="bi bi-info"></i> masukkan pekerjaan wali</p>
                                        <input type="text" name="pekerjaan-wali" id="pekerjaan-wali" class="form-control" />
                                        <label class="form-label" for="pekerjaan-wali">Pekerjaan Wali Murid</label>
                                    </div>

                                    <!-- Pendidikan Terakhir Wali -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-pendidikan-terakhir-wali" id="empty-pendidikan-terakhir-wali"><i class="bi bi-info"></i> masukkan pendidikan terakhir wali</p>
                                        <input type="text" name="pendidikan-terakhir-wali" id="pendidikan-terakhir-wali" class="form-control" />
                                        <label class="form-label" for="pendidikan-terakhir-wali">Pendidikan Terakhir Wali Murid</label>
                                    </div>

                                    <!-- No hp Ayah -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nohp-ayah" id="empty-nohp-ayah"><i class="bi bi-info"></i> masukkan no hp ayah</p>
                                        <input type="tel" name="nohp-ayah" id="nohp-ayah" class="form-control" />
                                        <label class="form-label" for="nohp-ayah">No hp Ayah</label>
                                    </div>

                                    <!-- No hp Ibu -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nohp-ibu" id="empty-nohp-ibu"><i class="bi bi-info"></i> masukkan no hp ibu</p>
                                        <input type="tel" name="nohp-ibu" id="nohp-ibu" class="form-control" />
                                        <label class="form-label" for="nohp-ibu">No hp Ibu</label>
                                    </div>

                                    <!-- No hp Wali -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-nohp-wali" id="empty-nohp-wali"><i class="bi bi-info"></i> masukkan no hp wali</p>
                                        <input type="tel" name="nohp-wali" id="nohp-wali" class="form-control" />
                                        <label class="form-label" for="nohp-wali">No hp Wali Murid</label>
                                    </div>

                                    <!-- Darimana Kamu Mengetahui PPDB ini? -->
                                    <div class="form-outline mb-0">
                                    <p class="text-danger mb-0" name="empty-darimana-tau" id="empty-darimana-tau"><i class="bi bi-info"></i> masukkan jawaban</p>
                                        <input type="text" name="darimana-tau" id="darimana-tau" class="form-control" />
                                        <label class="form-label" for="darimana-tau">Darimana Kamu Mengetahui PPDB ini?</label>
                                    </div>

                                    <div class="pt-1 mb-4 d-flex align-items-center gap-3">
                                        <button class="cta-ppdb" name="kirim-formulir" id="kirim-formulir" type="submit">KIRIM FORMULIR</button>
                                        <a href="../">Kembali</a>
                                    </div>

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
        $('#empty-jurusan').css('opacity', '0');
        $('#empty-nama-peserta-didik').css('opacity', '0');
        $('#empty-gender').css('opacity', '0');
        $('#empty-nisn').css('opacity', '0');
        $('#empty-alamat').css('opacity', '0');
        $('#empty-tempat-lahir').css('opacity', '0');
        $('#empty-tanggal-lahir').css('opacity', '0');
        $('#empty-saudara').css('opacity', '0');
        $('#empty-nohp').css('opacity', '0');
        $('#empty-email').css('opacity', '0');
        $('#empty-sekolah-asal').css('opacity', '0');
        $('#empty-tahun-lulus').css('opacity', '0');
        $('#empty-pas-foto').css('opacity', '0');
        $('#empty-nokk').css('opacity', '0');
        $('#empty-nama-ayah').css('opacity', '0');
        $('#empty-pekerjaan-ayah').css('opacity', '0');
        $('#empty-pendidikan-terakhir-ayah').css('opacity', '0');
        $('#empty-nama-ibu').css('opacity', '0');
        $('#empty-pekerjaan-ibu').css('opacity', '0');
        $('#empty-pendidikan-terakhir-ibu').css('opacity', '0');
        $('#empty-nama-wali').css('opacity', '0');
        $('#empty-pekerjaan-wali').css('opacity', '0');
        $('#empty-pendidikan-terakhir-wali').css('opacity', '0');
        $('#empty-nohp-ayah').css('opacity', '0');
        $('#empty-nohp-ibu').css('opacity', '0');
        $('#empty-nohp-wali').css('opacity', '0');
        $('#empty-darimana-tau').css('opacity', '0');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-pasfoto')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#kirim-formulir').on('click', function()
        {
            if( $('#jurusan').val().length === 0 ) {
                $('#jurusan').addClass('border-danger');
                $('#empty-jurusan').css('opacity', '1');
                

                $("#jurusan").keypress(function(){
                    $('#jurusan').removeClass('border-danger');
                    $('#empty-jurusan').css('opacity', '0');
                });
            }

            if( $('#nama-peserta-didik').val().length === 0 ) {
                $('#nama-peserta-didik').addClass('border-danger');
                $('#empty-nama-peserta-didik').css('opacity', '1');
                

                $("#nama-peserta-didik").keypress(function(){
                    $('#nama-peserta-didik').removeClass('border-danger');
                    $('#empty-nama-peserta-didik').css('opacity', '0');
                });
            }

            if( $('#gender').val().length === 0 ) {
                $('#gender').addClass('border-danger');
                $('#empty-gender').css('opacity', '1');
                

                $("#gender").keypress(function(){
                    $('#gender').removeClass('border-danger');
                    $('#empty-gender').css('opacity', '0');
                });
            }

            if( $('#tempat-lahir').val().length === 0 ) {
                $('#tempat-lahir').addClass('border-danger');
                $('#empty-tempat-lahir').css('opacity', '1');
                

                $("#tempat-lahir").keypress(function(){
                    $('#tempat-lahir').removeClass('border-danger');
                    $('#empty-tempat-lahir').css('opacity', '0');
                });
            }

            if( $('#tanggal-lahir').val().length === 0 ) {
                $('#tanggal-lahir').addClass('border-danger');
                $('#empty-tanggal-lahir').css('opacity', '1');
                

                $("#tanggal-lahir").keypress(function(){
                    $('#tanggal-lahir').removeClass('border-danger');
                    $('#empty-tanggal-lahir').css('opacity', '0');
                });
            }

            if( $('#saudara').val().length === 0 ) {
                $('#saudara').addClass('border-danger');
                $('#empty-saudara').css('opacity', '1');
                

                $("#saudara").keypress(function(){
                    $('#saudara').removeClass('border-danger');
                    $('#empty-saudara').css('opacity', '0');
                });
            }

            if( $('#nohp').val().length === 0 ) {
                $('#nohp').addClass('border-danger');
                $('#empty-nohp').css('opacity', '1');
                

                $("#nohp").keypress(function(){
                    $('#nohp').removeClass('border-danger');
                    $('#empty-nohp').css('opacity', '0');
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

            if( $('#sekolah-asal').val().length === 0 ) {
                $('#sekolah-asal').addClass('border-danger');
                $('#empty-sekolah-asal').css('opacity', '1');
                

                $("#sekolah-asal").keypress(function(){
                    $('#sekolah-asal').removeClass('border-danger');
                    $('#empty-sekolah-asal').css('opacity', '0');
                });
            }
            
            if( $('#tahun-lulus').val().length === 0 ) {
                $('#tahun-lulus').addClass('border-danger');
                $('#empty-tahun-lulus').css('opacity', '1');
                

                $("#tahun-lulus").keypress(function(){
                    $('#tahun-lulus').removeClass('border-danger');
                    $('#empty-tahun-lulus').css('opacity', '0');
                });
            }

            if( $('#pas-foto').val().length === 0 ) {
                $('#pas-foto').addClass('border-danger');
                $('#empty-pas-foto').css('opacity', '1');
                

                $("#pas-foto").keypress(function(){
                    $('#pas-foto').removeClass('border-danger');
                    $('#empty-pas-foto').css('opacity', '0');
                });
            }

            if( $('#nokk').val().length === 0 ) {
                $('#nokk').addClass('border-danger');
                $('#empty-nokk').css('opacity', '1');
                

                $("#nokk").keypress(function(){
                    $('#nokk').removeClass('border-danger');
                    $('#empty-nokk').css('opacity', '0');
                });
            }

            if( $('#nama-ayah').val().length === 0 ) {
                $('#nama-ayah').addClass('border-danger');
                $('#empty-nama-ayah').css('opacity', '1');
                

                $("#nama-ayah").keypress(function(){
                    $('#nama-ayah').removeClass('border-danger');
                    $('#empty-nama-ayah').css('opacity', '0');
                });
            }

            if( $('#pekerjaan-ayah').val().length === 0 ) {
                $('#pekerjaan-ayah').addClass('border-danger');
                $('#empty-pekerjaan-ayah').css('opacity', '1');
                

                $("#pekerjaan-ayah").keypress(function(){
                    $('#pekerjaan-ayah').removeClass('border-danger');
                    $('#empty-pekerjaan-ayah').css('opacity', '0');
                });
            }

            if( $('#pendidikan-terakhir-ayah').val().length === 0 ) {
                $('#pendidikan-terakhir-ayah').addClass('border-danger');
                $('#empty-pendidikan-terakhir-ayah').css('opacity', '1');
                

                $("#pendidikan-terakhir-ayah").keypress(function(){
                    $('#pendidikan-terakhir-ayah').removeClass('border-danger');
                    $('#empty-pendidikan-terakhir-ayah').css('opacity', '0');
                });
            }

            if( $('#nama-ibu').val().length === 0 ) {
                $('#nama-ibu').addClass('border-danger');
                $('#empty-nama-ibu').css('opacity', '1');
                

                $("#nama-ibu").keypress(function(){
                    $('#nama-ibu').removeClass('border-danger');
                    $('#empty-nama-ibu').css('opacity', '0');
                });
            }

            if( $('#pekerjaan-ibu').val().length === 0 ) {
                $('#pekerjaan-ibu').addClass('border-danger');
                $('#empty-pekerjaan-ibu').css('opacity', '1');
                

                $("#pekerjaan-ibu").keypress(function(){
                    $('#pekerjaan-ibu').removeClass('border-danger');
                    $('#empty-pekerjaan-ibu').css('opacity', '0');
                });
            }

            if( $('#pendidikan-terakhir-ibu').val().length === 0 ) {
                $('#pendidikan-terakhir-ibu').addClass('border-danger');
                $('#empty-pendidikan-terakhir-ibu').css('opacity', '1');
                

                $("#pendidikan-terakhir-ibu").keypress(function(){
                    $('#pendidikan-terakhir-ibu').removeClass('border-danger');
                    $('#empty-pendidikan-terakhir-ibu').css('opacity', '0');
                });
            }

            if( $('#nama-wali').val().length === 0 ) {
                $('#nama-wali').addClass('border-danger');
                $('#empty-nama-wali').css('opacity', '1');
                

                $("#nama-wali").keypress(function(){
                    $('#nama-wali').removeClass('border-danger');
                    $('#empty-nama-wali').css('opacity', '0');
                });
            }

            if( $('#pekerjaan-wali').val().length === 0 ) {
                $('#pekerjaan-wali').addClass('border-danger');
                $('#empty-pekerjaan-wali').css('opacity', '1');
                

                $("#pekerjaan-wali").keypress(function(){
                    $('#pekerjaan-wali').removeClass('border-danger');
                    $('#empty-pekerjaan-wali').css('opacity', '0');
                });
            }

            if( $('#pendidikan-terakhir-wali').val().length === 0 ) {
                $('#pendidikan-terakhir-wali').addClass('border-danger');
                $('#empty-pendidikan-terakhir-wali').css('opacity', '1');
                

                $("#pendidikan-terakhir-wali").keypress(function(){
                    $('#pendidikan-terakhir-wali').removeClass('border-danger');
                    $('#empty-pendidikan-terakhir-wali').css('opacity', '0');
                });
            }

            if( $('#nohp-ayah').val().length === 0 ) {
                $('#nohp-ayah').addClass('border-danger');
                $('#empty-nohp-ayah').css('opacity', '1');
                

                $("#nohp-ayah").keypress(function(){
                    $('#nohp-ayah').removeClass('border-danger');
                    $('#empty-nohp-ayah').css('opacity', '0');
                });
            }

            if( $('#nohp-ibu').val().length === 0 ) {
                $('#nohp-ibu').addClass('border-danger');
                $('#empty-nohp-ibu').css('opacity', '1');
                

                $("#nohp-ibu").keypress(function(){
                    $('#nohp-ibu').removeClass('border-danger');
                    $('#empty-nohp-ibu').css('opacity', '0');
                });
            }

            if( $('#nohp-wali').val().length === 0 ) {
                $('#nohp-wali').addClass('border-danger');
                $('#empty-nohp-wali').css('opacity', '1');
                

                $("#nohp-wali").keypress(function(){
                    $('#nohp-wali').removeClass('border-danger');
                    $('#empty-nohp-wali').css('opacity', '0');
                });
            }

            if( $('#darimana-tau').val().length === 0 ) {
                $('#darimana-tau').addClass('border-danger');
                $('#empty-darimana-tau').css('opacity', '1');
                

                $("#darimana-tau").keypress(function(){
                    $('#darimana-tau').removeClass('border-danger');
                    $('#empty-darimana-tau').css('opacity', '0');
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