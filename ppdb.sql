-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2023 pada 12.09
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `akun` varchar(75) DEFAULT NULL,
  `status` varchar(25) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `nama_peserta_didik` varchar(75) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `nisn` int(25) NOT NULL,
  `alamat_rumah` text NOT NULL,
  `tempat_lahir` varchar(75) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `anak_ke` int(11) NOT NULL,
  `dari_berapa_bersaudara` int(11) NOT NULL,
  `no_hp` varchar(35) NOT NULL,
  `email` varchar(75) NOT NULL,
  `sekolah_asal` varchar(75) NOT NULL,
  `tahun_lulus` varchar(50) NOT NULL,
  `tanggal_pendaftaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `pas_foto` blob NOT NULL,
  `no_kartu_keluarga` bigint(50) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `pekerjaan_ayah` varchar(75) NOT NULL,
  `pendidikan_terakhir_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(75) NOT NULL,
  `pendidikan_terakhir_ibu` varchar(50) NOT NULL,
  `nama_wali` varchar(50) NOT NULL,
  `pekerjaan_wali` varchar(75) NOT NULL,
  `pendidikan_terakhir_wali` varchar(50) NOT NULL,
  `no_hp_ayah` varchar(35) NOT NULL,
  `no_hp_ibu` varchar(35) NOT NULL,
  `no_hp_wali` varchar(35) NOT NULL,
  `darimana_tau_ppdb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `user_id`, `akun`, `status`, `jurusan`, `nama_peserta_didik`, `jenis_kelamin`, `nisn`, `alamat_rumah`, `tempat_lahir`, `tanggal_lahir`, `anak_ke`, `dari_berapa_bersaudara`, `no_hp`, `email`, `sekolah_asal`, `tahun_lulus`, `tanggal_pendaftaran`, `pas_foto`, `no_kartu_keluarga`, `nama_ayah`, `pekerjaan_ayah`, `pendidikan_terakhir_ayah`, `nama_ibu`, `pekerjaan_ibu`, `pendidikan_terakhir_ibu`, `nama_wali`, `pekerjaan_wali`, `pendidikan_terakhir_wali`, `no_hp_ayah`, `no_hp_ibu`, `no_hp_wali`, `darimana_tau_ppdb`) VALUES
(6, 9, 'xann', 'proses', 'rekayasa prangkat lunak', 's', 'laki laki', 6454, 'sgsgs', 'sgsg', '2023-03-11', 1, 2, '45455454554', 'undefinded@gmail.com', 'ashs', '2023-03', '2023-03-11 09:41:54', 0x494d475f32303233303330375f3230333434382e6a7067, 94949484, 'a', 'gsg', 'svavs', 'sgag', 'sgag', 'sgag', 'sga', 'sga', 'aga', '943', '464', '544', 'asggs'),
(7, 19, 'angel', 'disetujui', 'akutansi', 'Angel', 'perempuan', 2147483647, 'Batam, Bengkong', 'Batam', '2007-03-11', 2, 3, '45455454554', 'dummy@data', 'SMP 82', '2022-06', '2023-03-11 09:58:35', 0x494d475f32303233303232315f3131313934372e6a7067, 888757548, 'bapak', 'Karyawan Swasta ', 'SMK', 'ibu', 'karyawan Swasta ', 'SMA', 'wali', 'Karyawan Swasta ', 'SMA', '88275844', '875277694', '645758494', 'dari Panji '),
(8, 20, 'Yoga', 'disetujui', 'akutansi', 'Yoga', 'laki laki', 558488045, 'Batam, Batuaji', 'Batam', '2007-01-10', 2, 4, '9858588', 'yoga@gmail.com', 'SMP 92', '2023-06', '2023-03-11 23:21:11', 0x494d475f32303233303330365f3131323633312e6a7067, 2245855, 'bapak', 'Karyawan Swasta ', 'SMK', 'ibu', 'karyawan Swasta ', 'SMA', 'wali', 'Karyawan Swasta ', 'SMA', '85548778', '0875756555', '5500054585', 'website ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `role` varchar(25) DEFAULT NULL,
  `username` varchar(75) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `role`, `username`, `password`, `email`) VALUES
(2, 'admin', 'mey', '$2y$10$PPMPNLwhZ/Dh3kZheVML7.HbTHQQEmkpk8zKC7xYhYyaeQnho.8e2', 'mey@gmail.com'),
(3, 'user', 'tester', '$2y$10$79vMxpehvzsY9ijqhEU1ouOZBXVdmLyAk7d5Cl1xfEo3o0Hb3L8he', 'tester@tester'),
(4, 'user', 'tes1', '$2y$10$207ck3MQqsrSWDMD4ZzaRuI9Z7p/wpZgBtFj.F4Q8TZI/nggD0OPa', 'dummy@data'),
(5, 'user', 'tes2', '$2y$10$WPz9OTqpygCniUs4OONIm.6fM.O8XDC3stbj.mhHSNUCeEpP96GZu', 'dummy@data'),
(6, 'user', 'tes3', '$2y$10$Pw2YMVUk28/qYjuPTMmtBerPo07CVoM0qZI8VHGHb6yvB8gDi/q5m', 'dummy@data'),
(7, 'user', 'tes4', '$2y$10$lgNV5nn/70XJZqqEBKfw2O19Lnso6fm5dHyhSa61Bj/IkaQjzv3xi', 'dummy@data'),
(8, 'user', 'p', '$2y$10$T4ESSJPYUYiwPQ/pc0tntuJDZdpqeayuX/Q0UjvEUxn5TY3dfeI3y', 'dummy@data'),
(9, 'user', 'xann', '$2y$10$dCcDZu4rw0z.M4xhTicpmu7Mo0OPPA5WMClVdt.bRJdBWbsAOMVLm', 'dummy@data'),
(10, 'user', 'xannn', '$2y$10$J5ht.hiSomPE4mqHdUQLvuOoCi44X5dKJJaEu4Nv0i6JPFIdY2y6.', 'dummy@data'),
(11, 'user', 'tess', '$2y$10$caiYG3gShykq3VwywLCbu.QIrsPALA8UUr8Sh0QD2co8hKe3pCnea', 'dummy@data'),
(12, 'user', 'christian', '$2y$10$B19Ve9iAn.pam2bZ/4Y.KuG62SPYtLL0Qyq70SmKdYie3bCetWEL.', 'dummy@data'),
(13, 'user', 'set', '$2y$10$VMDSDAEAh6F8ovv6Fh18mOwMY99PCAtwO0L1L.zbuHrm30CTYKcVm', 'dummy@data'),
(14, 'user', 'y', '$2y$10$hfxfC7rI7.xR0Pg4jKfUnOAR1UCsJWBpmx/wyzOmQ8zoFbZfayDYu', 'y@y'),
(15, 'user', 'sh', '$2y$10$KQkfmohgN5Yy05VLPOdeT.932wV0UtMNxeaWxwIQ62TKGp.783p5q', 'z@s'),
(16, 'user', 'pa', '$2y$10$GFiNgMxTT8ItBlOg4GXWuehO9Rst2jzbyLvouKVnsJdEDbj1r70y2', 'hahsjajs@jaj'),
(17, 'user', 'hjj', '$2y$10$EsdEIY1K.2LLUYxLNi.BBuhcWe.FI/.S8ak05dy/0ugjarHTzANja', 'hahsjajs@jaj'),
(18, 'user', 'cuy', '$2y$10$0pf4lyKQUkaeYA34chn/LODyNL/G2UJCE3tJaYhh56zZV1PXdec/O', 'cuy@a'),
(19, 'user', 'angel', '$2y$10$OlFOFF8xLmwgexVZ9kZskOPKYL078gz.ULAZ/qxTgCKTgu0OnPely', 'angel@gmail.com'),
(20, 'user', 'Yoga', '$2y$10$v/UMFLSDft8jxyGCuJ4Y7O.I67QDYlJmMPjxrL7ixWqKMeIHUOr4C', 'dummy@data'),
(21, 'user', 'x', '$2y$10$HNZkpIn0y6Oo7MknyTcYv.N0es0TqSlVCv3pFSIpJAKD9ZmCmAfga', 'dummy@data'),
(22, 'user', 'pj', '$2y$10$mxnniTplD02QdRpvjPn3ferWDgzDJy4YoilycIg1lY0Fd8s0ZSE0i', 'dummy@data');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
